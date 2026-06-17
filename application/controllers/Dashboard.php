<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="telah_login"){
			redirect(base_url().'login?alert=belum_login');
		}
	}

	public function index()
	{
		// hitung jumlah artikel
		$data['jumlah_artikel'] = $this->m_data->get_data('artikel')->num_rows();
		// hitung jumlah kategori
		$data['jumlah_kategori'] = $this->m_data->get_data('kategori')->num_rows();
		// hitung jumlah pengguna
		$data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
		// hitung jumlah halaman
		$data['jumlah_halaman'] = $this->m_data->get_data('halaman')->num_rows();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama','Password Lama','required');
		$this->form_validation->set_rules('password_baru','Password Baru','required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|matches[password_baru]');

		// cek validasi
		if($this->form_validation->run() != false){

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
			$where = array(
				'pengguna_id' => $this->session->userdata('id'),
				'pengguna_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			// cek kesesuaikan password lama
			if($cek > 0){

				// update data password pengguna
				$w = array(
					'pengguna_id' => $this->session->userdata('id')
				);
				$data = array(
					'pengguna_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'pengguna');

				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			}else{
				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}

	}

	// CRUD KATEGORI
	public function kategori()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_aksi()
	{
		$this->form_validation->set_rules('kategori','Kategori','required');

		if($this->form_validation->run() != false){

			$kategori = $this->input->post('kategori');

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->insert_data($data,'kategori');

			redirect(base_url().'dashboard/kategori');
			
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori_edit($id)
	{
		$where = array(
			'kategori_id' => $id
		);
		$data['kategori'] = $this->m_data->edit_data($where,'kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_update()
	{
		$this->form_validation->set_rules('kategori','Kategori','required');

		if($this->form_validation->run() != false){

			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');

			$where = array(
				'kategori_id' => $id
			);

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->update_data($where, $data,'kategori');

			redirect(base_url().'dashboard/kategori');
			
		}else{

			$id = $this->input->post('id');
			$where = array(
				'kategori_id' => $id
			);
			$data['kategori'] = $this->m_data->edit_data($where,'kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function kategori_hapus($id)
	{
		$where = array(
			'kategori_id' => $id
		);

		$this->m_data->delete_data($where,'kategori');

		redirect(base_url().'dashboard/kategori');
	}
	// END CRUD KATEGORI

	// CRUD ARTIKEL
	public function artikel()
	{
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,kategori,pengguna WHERE artikel_kategori=kategori_id and artikel_author=pengguna_id order by artikel_id desc")->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_tambah()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_tambah',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul','Judul','required|is_unique[artikel.artikel_judul]');
		$this->form_validation->set_rules('konten','Konten','required');
		$this->form_validation->set_rules('kategori','Kategori','required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])){
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if($this->form_validation->run() != false){

			$config['upload_path']   = './gambar/artikel/';
			$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug = strtolower(url_title($judul));
				$konten = $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'artikel_tanggal' => $tanggal,
					'artikel_judul' => $judul,
					'artikel_slug' => $slug,
					'artikel_konten' => $konten,
					'artikel_sampul' => $sampul,
					'artikel_author' => $author,
					'artikel_kategori' => $kategori,
					'artikel_status' => $status,
				);

				$this->m_data->insert_data($data,'artikel');

				redirect(base_url().'dashboard/artikel');	
				
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->m_data->get_data('kategori')->result();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_artikel_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}

		}else{
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_tambah',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function artikel_edit($id)
	{
		$where = array(
			'artikel_id' => $id
		);
		$data['artikel'] = $this->m_data->edit_data($where,'artikel')->result();
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function artikel_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul','Judul','required');
		$this->form_validation->set_rules('konten','Konten','required');
		$this->form_validation->set_rules('kategori','Kategori','required');
		
		if($this->form_validation->run() != false){

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'artikel_id' => $id
			);

			$data = array(
				'artikel_judul' => $judul,
				'artikel_slug' => $slug,
				'artikel_konten' => $konten,
				'artikel_kategori' => $kategori,
				'artikel_status' => $status,
			);

			$this->m_data->update_data($where,$data,'artikel');


			if (!empty($_FILES['sampul']['name'])){
				$config['upload_path']   = './gambar/artikel/';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'artikel_sampul' => $gambar['file_name'],
					);

					$this->m_data->update_data($where,$data,'artikel');

					redirect(base_url().'dashboard/artikel');	

				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
					
					$where = array(
						'artikel_id' => $id
					);
					$data['artikel'] = $this->m_data->edit_data($where,'artikel')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_artikel_edit',$data);
					$this->load->view('dashboard/v_footer');
				}
			}else{
				redirect(base_url().'dashboard/artikel');	
			}

		}else{
			$id = $this->input->post('id');
			$where = array(
				'artikel_id' => $id
			);
			$data['artikel'] = $this->m_data->edit_data($where,'artikel')->result();
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function artikel_hapus($id)
	{
		$where = array(
			'artikel_id' => $id
		);

		$this->m_data->delete_data($where,'artikel');

		redirect(base_url().'dashboard/artikel');
	}
	// end crud artikel


	// CRUD PAGES
	public function pages()
	{
		$data['halaman'] = $this->m_data->get_data('halaman')->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pages_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pages_aksi()
	{
		// Wajib isi judul,konten
		$this->form_validation->set_rules('judul','Judul','required|is_unique[halaman.halaman_judul]');
		$this->form_validation->set_rules('konten','Konten','required');

		if($this->form_validation->run() != false){

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->insert_data($data,'halaman');

			// alihkan kembali ke method pages
			redirect(base_url().'dashboard/pages');	

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_edit($id)
	{
		$where = array(
			'halaman_id' => $id
		);
		$data['halaman'] = $this->m_data->edit_data($where,'halaman')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function pages_update()
	{
		// Wajib isi judul,konten 
		$this->form_validation->set_rules('judul','Judul','required');
		$this->form_validation->set_rules('konten','Konten','required');
		
		if($this->form_validation->run() != false){

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			
			$where = array(
				'halaman_id' => $id
			);

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->update_data($where,$data,'halaman');

			redirect(base_url().'dashboard/pages');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'halaman_id' => $id
			);
			$data['halaman'] = $this->m_data->edit_data($where,'halaman')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_hapus($id)
	{
		$where = array(
			'halaman_id' => $id
		);
		
		$this->m_data->delete_data($where,'halaman');

		redirect(base_url().'dashboard/pages');
	}
	// end crud pages


	public function profil()
	{
		// id pengguna yang sedang login
		$id_pengguna = $this->session->userdata('id');

		$where = array(
			'pengguna_id' => $id_pengguna
		);

		$data['profil'] = $this->m_data->edit_data($where,'pengguna')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_profil',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('email','Email','required');
		
		if($this->form_validation->run() != false){

			$id = $this->session->userdata('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			
			$where = array(
				'pengguna_id' => $id
			);

			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_email' => $email
			);

			$this->m_data->update_data($where,$data,'pengguna');

			redirect(base_url().'dashboard/profil/?alert=sukses');
		}else{
			// id pengguna yang sedang login
			$id_pengguna = $this->session->userdata('id');

			$where = array(
				'pengguna_id' => $id_pengguna
			);

			$data['profil'] = $this->m_data->edit_data($where,'pengguna')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_profil',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pengaturan()
	{
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengaturan',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengaturan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama','Nama Website','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi Website','required');
		
		if($this->form_validation->run() != false){

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$link_instagram = $this->input->post('link_instagram');
			$link_youtube = $this->input->post('link_youtube');
			$link_tiktok = $this->input->post('link_tiktok');

			$where = array(

			);

			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'link_instagram' => $link_instagram,
				'link_youtube' => $link_youtube,
				'link_tiktok' => $link_tiktok
			);

			// update pengaturan
			$this->m_data->update_data($where,$data,'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])){
				
				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
					$gambar = $this->upload->data();

					$logo = $gambar['file_name'];
					
					$this->db->query("UPDATE pengaturan SET logo='$logo'");
				}
			}

			redirect(base_url().'dashboard/pengaturan/?alert=sukses');

		}else{
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengaturan',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD KELULUSAN
	public function kelulusan()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$data['kelulusan'] = $this->m_data->get_data('kelulusan')->result();
		$data['import_result'] = $this->session->flashdata('import_result');
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kelulusan',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function kelulusan_tambah()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kelulusan_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kelulusan_aksi()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nisn','NISN','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run() != false){
			$nisn = $this->input->post('nisn');
			$nama = $this->input->post('nama');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$status = $this->input->post('status');

			$data = array(
				'kelulusan_nisn' => $nisn,
				'kelulusan_nama' => $nama,
				'kelulusan_tempat_lahir' => $tempat_lahir,
				'kelulusan_tanggal_lahir' => $tanggal_lahir,
				'kelulusan_status' => $status
			);

			$this->m_data->insert_data($data,'kelulusan');
			redirect(base_url().'dashboard/kelulusan');
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kelulusan_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kelulusan_edit($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'kelulusan_id' => $id
		);
		$data['kelulusan'] = $this->m_data->edit_data($where,'kelulusan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kelulusan_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function kelulusan_update()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nisn','NISN','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run() != false){
			$id = $this->input->post('id');
			$nisn = $this->input->post('nisn');
			$nama = $this->input->post('nama');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$status = $this->input->post('status');

			$where = array(
				'kelulusan_id' => $id
			);

			$data = array(
				'kelulusan_nisn' => $nisn,
				'kelulusan_nama' => $nama,
				'kelulusan_tempat_lahir' => $tempat_lahir,
				'kelulusan_tanggal_lahir' => $tanggal_lahir,
				'kelulusan_status' => $status
			);

			$this->m_data->update_data($where,$data,'kelulusan');
			redirect(base_url().'dashboard/kelulusan');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'kelulusan_id' => $id
			);
			$data['kelulusan'] = $this->m_data->edit_data($where,'kelulusan')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kelulusan_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kelulusan_hapus($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'kelulusan_id' => $id
		);
		$this->m_data->delete_data($where,'kelulusan');
		redirect(base_url().'dashboard/kelulusan');
	}

	public function kelulusan_import()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$data['import_result'] = $this->session->flashdata('import_result');
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kelulusan_import', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kelulusan_template()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->_siapkan_output_excel();
		require_once APPPATH.'third_party/simplexlsxgen/SimpleXLSXGen.php';

		$rows = array(
			array('NISN', 'Nama', 'Tempat Lahir', 'Tanggal Lahir', 'Status'),
			array('0138516647', 'CONTOH NAMA SISWA', 'Jakarta', '06/12/2013', 'LULUS')
		);

		$xlsx = \Shuchkin\SimpleXLSXGen::fromArray($rows, 'Data Kelulusan');
		$xlsx->downloadAs('template_kelulusan.xlsx');
		exit;
	}

	public function kelulusan_import_aksi()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$upload_path = './uploads/kelulusan/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}

		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size']      = 5120;
		$config['encrypt_name']  = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_excel')) {
			$this->session->set_flashdata('import_result', array(
				'error' => $this->upload->display_errors('', '')
			));
			redirect(base_url().'dashboard/kelulusan_import');
		}

		$file = $this->upload->data();
		$file_path = $file['full_path'];

		$result = $this->_proses_import_kelulusan($file_path);
		@unlink($file_path);

		$this->session->set_flashdata('import_result', $result);
		redirect(base_url().'dashboard/kelulusan');
	}

	private function _siapkan_output_excel()
	{
		while (ob_get_level() > 0) {
			ob_end_clean();
		}
		@ini_set('display_errors', '0');
	}

	private function _baca_baris_spreadsheet($file_path)
	{
		$extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

		if ($extension === 'csv') {
			return $this->_baca_baris_csv($file_path);
		}

		if ($extension === 'xlsx') {
			require_once APPPATH.'third_party/simplexlsx/SimpleXLSX.php';
			$xlsx = \Shuchkin\SimpleXLSX::parse($file_path);
			if (!$xlsx) {
				throw new \Exception(\Shuchkin\SimpleXLSX::parseError());
			}
			return $xlsx->rows();
		}

		if ($extension === 'xls') {
			require_once APPPATH.'third_party/simplexls/SimpleXLS.php';
			$xls = \Shuchkin\SimpleXLS::parse($file_path);
			if (!$xls) {
				throw new \Exception(\Shuchkin\SimpleXLS::parseError());
			}
			return $xls->rows();
		}

		throw new \Exception('Format file tidak didukung');
	}

	private function _baca_baris_csv($file_path)
	{
		$rows = array();
		$handle = fopen($file_path, 'r');
		if ($handle === false) {
			throw new \Exception('File CSV tidak dapat dibuka');
		}

		while (($row = fgetcsv($handle, 0, ',')) !== false) {
			if (!empty($row) && isset($row[0])) {
				$row[0] = preg_replace('/^\xEF\xBB\xBF/', '', (string) $row[0]);
			}
			$rows[] = $row;
		}
		fclose($handle);

		return $rows;
	}

	private function _proses_import_kelulusan($file_path)
	{
		$success = 0;
		$failed = array();
		$skipped = array();
		$seen_nisn = array();

		try {
			$rows = $this->_baca_baris_spreadsheet($file_path);
		} catch (\Exception $e) {
			return array('error' => 'File Excel tidak dapat dibaca. Pastikan format file benar.');
		}

		if (count($rows) < 2) {
			return array('error' => 'File Excel kosong atau tidak memiliki data.');
		}

		$start_row = 0;
		$first_row = array_map('strtolower', array_map('trim', array_map('strval', $rows[0])));
		if (in_array('nisn', $first_row, true)) {
			$start_row = 1;
		}

		for ($i = $start_row; $i < count($rows); $i++) {
			$row_num = $i + 1;
			$row = $rows[$i];

			$nisn = isset($row[0]) ? preg_replace('/\D/', '', trim((string)$row[0])) : '';
			$nama = isset($row[1]) ? trim((string)$row[1]) : '';
			$tempat_lahir = isset($row[2]) ? trim((string)$row[2]) : '';
			$tanggal_raw = isset($row[3]) ? $row[3] : '';
			$status = isset($row[4]) ? strtoupper(trim((string)$row[4])) : '';

			if ($nisn === '' && $nama === '' && $tempat_lahir === '' && $tanggal_raw === '' && $status === '') {
				continue;
			}

			if ($nisn === '' || $nama === '' || $tempat_lahir === '' || $tanggal_raw === '' || $status === '') {
				$failed[] = array('row' => $row_num, 'message' => 'Data tidak lengkap');
				continue;
			}

			if (isset($seen_nisn[$nisn])) {
				$skipped[] = array('row' => $row_num, 'nisn' => $nisn, 'message' => 'NISN sudah terdaftar (duplikat di file)');
				continue;
			}
			$seen_nisn[$nisn] = true;

			if ($this->m_data->nisn_exists($nisn)) {
				$skipped[] = array('row' => $row_num, 'nisn' => $nisn, 'message' => 'NISN sudah terdaftar');
				continue;
			}

			$tanggal_lahir = $this->_parse_tanggal_import($tanggal_raw);
			if ($tanggal_lahir === false) {
				$failed[] = array('row' => $row_num, 'message' => 'Format tanggal lahir tidak valid (gunakan DD/MM/YYYY)');
				continue;
			}

			if ($status !== 'LULUS' && $status !== 'TIDAK LULUS') {
				$failed[] = array('row' => $row_num, 'message' => 'Status harus LULUS atau TIDAK LULUS');
				continue;
			}

			$data = array(
				'kelulusan_nisn' => $nisn,
				'kelulusan_nama' => $nama,
				'kelulusan_tempat_lahir' => $tempat_lahir,
				'kelulusan_tanggal_lahir' => $tanggal_lahir,
				'kelulusan_status' => $status
			);

			$this->m_data->insert_data($data, 'kelulusan');
			$success++;
		}

		return array(
			'success' => $success,
			'failed' => $failed,
			'skipped' => $skipped
		);
	}

	private function _parse_tanggal_import($value)
	{
		if ($value === null || $value === '') {
			return false;
		}

		if (is_numeric($value)) {
			$serial = (float) $value;
			if ($serial >= 1 && $serial <= 2958465) {
				$tanggal = $this->_excel_serial_ke_tanggal($serial);
				if ($tanggal !== false) {
					return $tanggal;
				}
			}
		}

		$value = trim((string)$value);

		if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $m)) {
			return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
		}

		if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
			return $value;
		}

		$time = strtotime($value);
		if ($time !== false) {
			return date('Y-m-d', $time);
		}

		return false;
	}

	private function _excel_serial_ke_tanggal($serial)
	{
		$unix_timestamp = (int) round(($serial - 25569) * 86400);
		if ($unix_timestamp <= 0) {
			return false;
		}
		return gmdate('Y-m-d', $unix_timestamp);
	}
	// end crud kelulusan

	// CRUD FASILITAS
	public function fasilitas()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$data['fasilitas'] = $this->m_data->get_data('fasilitas')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fasilitas',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function fasilitas_tambah()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fasilitas_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function fasilitas_aksi()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nama','Nama','required');
		if (empty($_FILES['gambar']['name'])){
			$this->form_validation->set_rules('gambar', 'Gambar', 'required');
		}

		if($this->form_validation->run() != false){
			if(!is_dir('./gambar/fasilitas/')){
				mkdir('./gambar/fasilitas/', 0777, true);
			}

			$config['upload_path']   = './gambar/fasilitas/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar')) {
				$gambar = $this->upload->data();

				$nama = $this->input->post('nama');
				$file = $gambar['file_name'];

				$data = array(
					'fasilitas_nama' => $nama,
					'fasilitas_gambar' => $file
				);

				$this->m_data->insert_data($data,'fasilitas');
				redirect(base_url().'dashboard/fasilitas');
			} else {
				$data['gambar_error'] = $this->upload->display_errors();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_fasilitas_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_fasilitas_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function fasilitas_edit($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'fasilitas_id' => $id
		);
		$data['fasilitas'] = $this->m_data->edit_data($where,'fasilitas')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_fasilitas_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function fasilitas_update()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run() != false){
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');

			$where = array(
				'fasilitas_id' => $id
			);

			$data = array(
				'fasilitas_nama' => $nama
			);

			if (!empty($_FILES['gambar']['name'])){
				if(!is_dir('./gambar/fasilitas/')){
					mkdir('./gambar/fasilitas/', 0777, true);
				}

				$config['upload_path']   = './gambar/fasilitas/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('gambar')) {
					$gambar = $this->upload->data();
					$data['fasilitas_gambar'] = $gambar['file_name'];
				}else{
					$data['gambar_error'] = $this->upload->display_errors();
					$data['fasilitas'] = $this->m_data->edit_data($where,'fasilitas')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_fasilitas_edit',$data);
					$this->load->view('dashboard/v_footer');
					return;
				}
			}

			$this->m_data->update_data($where,$data,'fasilitas');
			redirect(base_url().'dashboard/fasilitas');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'fasilitas_id' => $id
			);
			$data['fasilitas'] = $this->m_data->edit_data($where,'fasilitas')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_fasilitas_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function fasilitas_hapus($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'fasilitas_id' => $id
		);
		$this->m_data->delete_data($where,'fasilitas');
		redirect(base_url().'dashboard/fasilitas');
	}
	// end crud fasilitas

	// CRUD TESTIMONI
	public function testimoni()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->load->helper('text');
		$data['testimoni'] = $this->db->query("SELECT * FROM testimoni ORDER BY testimoni_urutan ASC, testimoni_id ASC")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function testimoni_tambah()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function testimoni_aksi()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('isi','Isi Testimoni','required');
		$this->form_validation->set_rules('urutan','Urutan','required|integer');
		if (empty($_FILES['foto']['name'])){
			$this->form_validation->set_rules('foto', 'Foto', 'required');
		}

		if($this->form_validation->run() != false){
			if(!is_dir('./gambar/testimoni/')){
				mkdir('./gambar/testimoni/', 0755, true);
			}

			$config['upload_path']   = './gambar/testimoni/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
			$config['max_size']      = 2048;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				$foto = $this->upload->data();

				$data = array(
					'testimoni_nama' => $this->input->post('nama'),
					'testimoni_isi' => $this->input->post('isi'),
					'testimoni_foto' => $foto['file_name'],
					'testimoni_urutan' => $this->input->post('urutan')
				);

				$this->m_data->insert_data($data,'testimoni');
				redirect(base_url().'dashboard/testimoni');
			} else {
				$data['foto_error'] = $this->upload->display_errors();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_testimoni_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}
		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_testimoni_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function testimoni_edit($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'testimoni_id' => $id
		);
		$data['testimoni'] = $this->m_data->edit_data($where,'testimoni')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni_edit',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function testimoni_update()
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('isi','Isi Testimoni','required');
		$this->form_validation->set_rules('urutan','Urutan','required|integer');

		if($this->form_validation->run() != false){
			$id = $this->input->post('id');

			$where = array(
				'testimoni_id' => $id
			);

			$data = array(
				'testimoni_nama' => $this->input->post('nama'),
				'testimoni_isi' => $this->input->post('isi'),
				'testimoni_urutan' => $this->input->post('urutan')
			);

			if (!empty($_FILES['foto']['name'])){
				if(!is_dir('./gambar/testimoni/')){
					mkdir('./gambar/testimoni/', 0755, true);
				}

				$config['upload_path']   = './gambar/testimoni/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
				$config['max_size']      = 2048;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$foto = $this->upload->data();
					$data['testimoni_foto'] = $foto['file_name'];
				}else{
					$data['foto_error'] = $this->upload->display_errors();
					$data['testimoni'] = $this->m_data->edit_data($where,'testimoni')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_testimoni_edit',$data);
					$this->load->view('dashboard/v_footer');
					return;
				}
			}

			$this->m_data->update_data($where,$data,'testimoni');
			redirect(base_url().'dashboard/testimoni');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'testimoni_id' => $id
			);
			$data['testimoni'] = $this->m_data->edit_data($where,'testimoni')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_testimoni_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function testimoni_hapus($id)
	{
		if($this->session->userdata('level') != "admin"){
			redirect(base_url().'dashboard');
		}

		$where = array(
			'testimoni_id' => $id
		);
		$this->m_data->delete_data($where,'testimoni');
		redirect(base_url().'dashboard/testimoni');
	}
	// end crud testimoni

	// CRUD PENGGUNA
	public function pengguna()
	{
		$data['pengguna'] = $this->m_data->get_data('pengguna')->result();	
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama','Nama Pengguna','required');
		$this->form_validation->set_rules('email','Email Pengguna','required');
		$this->form_validation->set_rules('username','Username Pengguna','required');
		$this->form_validation->set_rules('password','Password Pengguna','required|min_length[8]');
		$this->form_validation->set_rules('level','Level Pengguna','required');
		$this->form_validation->set_rules('status','Status Pengguna','required');

		if($this->form_validation->run() != false){

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_email' => $email,
				'pengguna_username' => $username,
				'pengguna_password' => $password,
				'pengguna_level' => $level,
				'pengguna_status' => $status
			);


			$this->m_data->insert_data($data,'pengguna');

			redirect(base_url().'dashboard/pengguna');	

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_edit($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna'] = $this->m_data->edit_data($where,'pengguna')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_edit',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengguna_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama','Nama Pengguna','required');
		$this->form_validation->set_rules('email','Email Pengguna','required');
		$this->form_validation->set_rules('username','Username Pengguna','required');
		$this->form_validation->set_rules('level','Level Pengguna','required');
		$this->form_validation->set_rules('status','Status Pengguna','required');

		if($this->form_validation->run() != false){

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			if($this->input->post('password') == ""){
				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_email' => $email,
					'pengguna_username' => $username,
					'pengguna_level' => $level,
					'pengguna_status' => $status
				);
			}else{
				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_email' => $email,
					'pengguna_username' => $username,
					'pengguna_password' => $password,
					'pengguna_level' => $level,
					'pengguna_status' => $status
				);
			}
			
			$where = array(
				'pengguna_id' => $id
			);

			$this->m_data->update_data($where,$data,'pengguna');

			redirect(base_url().'dashboard/pengguna');
		}else{
			$id = $this->input->post('id');
			$where = array(
				'pengguna_id' => $id
			);
			$data['pengguna'] = $this->m_data->edit_data($where,'pengguna')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_edit',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_hapus($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna_hapus'] = $this->m_data->edit_data($where,'pengguna')->row();
		$data['pengguna_lain'] = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id != $id")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_hapus',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_hapus_aksi()
	{
		$pengguna_hapus = $this->input->post('pengguna_hapus');
		$pengguna_tujuan = $this->input->post('pengguna_tujuan');

		// hapus pengguna
		$where = array(
			'pengguna_id' => $pengguna_hapus
		);

		$this->m_data->delete_data($where,'pengguna');

		// pindahkan semua artikel pengguna yang dihapus ke pengguna yang dipilih
		$w = array(
			'artikel_author' => $pengguna_hapus
		);

		$d = array(
			'artikel_author' => $pengguna_tujuan
		);

		$this->m_data->update_data($w,$d,'artikel');

		redirect(base_url().'dashboard/pengguna');
	}
	// end crud pengguna
	
}
