<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_model {
	public function __construct() {
		parent::__construct();

	}

	public function getAllPayments($rate_category, $jenjang=-1, $start=null, $end=null) {
		if ($jenjang > -1) $jenjangFilter = ' AND kelas.dm_jenjang_id = ' . $jenjang;
		else $jenjangFilter = '';

		if (empty($start)) $start = date('Y-m-d');
		if (empty($end)) $end = $start;

$query = <<<EOL
SELECT payment.amount, id_student, id_rate, namalengkap, kelas, invoice.description, payment.installment, payment.remaining_amount
FROM ar_payment_details payment, ar_invoice invoice, sis_siswa siswa, dm_kelas kelas
WHERE invoice.id = payment.id_invoice AND siswa.id = invoice.id_student AND kelas.id = siswa.dm_kelas_id 
AND DATE_FORMAT(payment.created, '%Y-%m-%d') BETWEEN '$start' AND '$end' $jenjangFilter
AND EXISTS(SELECT 1 FROM ar_rate WHERE invoice.id_rate=ar_rate.id AND ar_rate.category = '$rate_category')
ORDER BY kelas.id, siswa.namalengkap
EOL;
		$rs = $this->db->query($query);
		return $rs->result();
	}

	public function getAllPendingInvoice($rate_category, $jenjang=-1, $start=null, $end=null) {
		if ($jenjang > -1) $jenjangFilter = ' AND kelas.dm_jenjang_id = ' . $jenjang;
		else $jenjangFilter = '';

		if (empty($start)) $start = date('Y-m-d');
		if (empty($end)) $end = $start;

$query = <<<EOL
SELECT id_student, id_rate, namalengkap, kelas, invoice.description, status, DATEDIFF('$start', invoice.due_date) elapsed, invoice.amount, invoice.received_amount, invoice.last_installment
FROM ar_invoice invoice, sis_siswa siswa, dm_kelas kelas
WHERE siswa.id = invoice.id_student AND kelas.id = siswa.dm_kelas_id AND (invoice.status = 1 OR invoice.status = 2)
AND DATE_FORMAT(invoice.due_date, '%Y-%m-%d') < '$start' $jenjangFilter
AND EXISTS(SELECT 1 FROM ar_rate WHERE invoice.id_rate=ar_rate.id AND ar_rate.category = '$rate_category')
ORDER BY kelas.id, siswa.namalengkap 
EOL;
		$rs = $this->db->query($query);
		return $rs->result();
	}

	public function getPaymentSummary($jenjang=-1, $start=null) {
		if ($jenjang > -1) $jenjangFilter = ' AND kelas.dm_jenjang_id = ' . $jenjang;
		else $jenjangFilter = '';

		if (empty($start)) $start = date('Y-m-d');

$query = <<<EOL
SELECT rate.category, rate.name, kelas.kelas, SUM(payment.amount) received 
	FROM ar_payment_details payment, ar_invoice invoice, sis_siswa siswa, dm_kelas kelas, ar_rate rate 
	WHERE invoice.id = payment.id_invoice AND siswa.id = invoice.id_student AND kelas.id = siswa.dm_kelas_id AND invoice.id_rate = rate.id 
		AND DATE_FORMAT(payment.created, '%Y-%m-%d') = '$start' $jenjangFilter
		GROUP BY rate.category, rate.name, kelas.kelas ORDER BY rate.category, rate.name, kelas.angka, kelas.kelas
EOL;
		$rs = $this->db->query($query);
		return $rs->result();
	}
}
