<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->library('Pdf');
    }

    public function laporan_perizinan()
    {
        $data['title'] = 'Laporan Perizinan';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id_rib     = $this->input->post('ribath');
        $id_kam     = $this->input->post('kamar');
        $tgl_awal  = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $santri = $this->db->get_where('santri', ['id_kamar' => $id_kam])->row_array();
        $ribath = $this->db->get_where('data_ribath', ['id' => $id_rib])->row_array();
        $kamar = $this->db->get_where('data_kamar', ['id' => $id_kam])->row_array();

        $this->db->where('tgl >=', $tgl_awal);
        $this->db->where('tgl <=', $tgl_akhir);
        $this->db->where('id_kamar', $id_kam);

        $data['laporan'] = $this->db->get('perizinan')->result_array();

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['santri'] = $santri;
        $data['ribath'] = $ribath['nama'];
        $data['kamar'] = $kamar['nama'];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'laporan-perizinan ' . $ribath['nama'] . '_' . $kamar['nama'] . ' .pdf';

        $this->pdf->load_view('laporan/laporan_perizinan', $data);
    }


    public function laporan_takziran()
    {
        $data['title'] = 'Laporan Takziran';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id_rib     = $this->input->post('ribath');
        $id_kam     = $this->input->post('kamar');
        $tgl_awal  = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $santri = $this->db->get_where('santri', ['id_kamar' => $id_kam])->row_array();
        $ribath = $this->db->get_where('data_ribath', ['id' => $id_rib])->row_array();
        $kamar = $this->db->get_where('data_kamar', ['id' => $id_kam])->row_array();

        $this->db->where('tgl >=', $tgl_awal);
        $this->db->where('tgl <=', $tgl_akhir);
        $this->db->where('id_kamar', $id_kam);
        $data['laporan'] = $this->db->get('takziran')->result_array();

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['santri'] = $santri;
        $data['ribath'] = $ribath['nama'];
        $data['kamar'] = $kamar['nama'];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'laporan-takziran ' . $ribath['nama'] . '_' . $kamar['nama'] . ' .pdf';

        $this->pdf->load_view('laporan/laporan_takziran', $data);
    }


    public function laporan_takziran_santri()
    {
        $data['title'] = 'Laporan Takziran';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id_san     = $this->input->post('santri');
        $tgl_awal  = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $santri = $this->db->get_where('santri', ['id' => $id_san])->row_array();

        $this->db->where('tgl >=', $tgl_awal);
        $this->db->where('tgl <=', $tgl_akhir);
        $this->db->where('id_santri', $id_san);
        $data['laporan'] = $this->db->get('takziran')->result_array();

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['santri'] = $santri['nama'];


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'laporan-takziran ' . $santri['nama'] . ' .pdf';

        $this->pdf->load_view('laporan/laporan_takziran', $data);
    }


    public function laporan_absen()
    {
        $data['title'] = 'Laporan Absen';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id     = $this->input->post('id');

        $this->db->where('role_absen', $id);
        $data['laporan'] = $this->db->get('absen')->result_array();

        $this->db->where('id', $id);
        $data['daftar_absen'] = $this->db->get('daftar_absen')->row_array();
        $id_ribath = $data['daftar_absen']['id_ribath'];
        $id_kamar = $data['daftar_absen']['id_kamar'];

        $data['ribath'] =  $this->db->get_where('data_ribath', ['id' => $id_ribath])->row_array();
        $data['kamar'] =  $this->db->get_where('data_kamar', ['id' => $id_kamar])->row_array();

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'Laporan-absen_' . $data['ribath']['nama'] . '_' . $data['kamar']['nama'] . '.pdf';

        $this->pdf->load_view('laporan/laporan_absen', $data);
    }


    public function laporan_konseling()
    {
        $data['title'] = 'Laporan Absen';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id     = $this->input->post('id');

        $this->db->where('role_konseling', $id);
        $this->db->order_by('id', 'asc');
        $data['laporan'] = $this->db->get('balas_konseling')->result_array();

        $this->db->where('id', $id);
        $data['konseling'] = $this->db->get('konseling')->row_array();
        $id_san = $data['konseling']['id_santri'];

        $data['santri'] = $this->db->get('santri', ['id' => $id_san])->row_array();

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'laporan-konseling_' . $data['konseling']['topik'] . '_' . $data['santri']['nama'] . '.pdf';

        $this->pdf->load_view('laporan/laporan_konseling', $data);
    }

    public function cetak_formulir()
    {
        $data['title'] = 'Cetak Formulir';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();

        $id     = $this->input->get('id');

        $data['ppdb'] = $this->db->get('ppdb', ['id' => $id])->row_array();

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'cetak_formulir_' . $data['ppdb']['nama'] . '.pdf';

        $this->pdf->load_view('laporan/cetakformulir', $data);
    }
}
