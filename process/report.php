<?php
    include('../db.php');
    require_once("../dompdf/autoload.inc.php");
    use Dompdf\Dompdf;

    $dompdf = new Dompdf(); 
    $query = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id)");
    $html = '<center><h3>Daftar Produk</h3></center><hr/><br><br><br>';
    $html .= '<table border="1" width="100%">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>';
    $no = 1;
    while($row = mysqli_fetch_array($query)) {
        $html .= "<tr>
        <td>".$no."</td>
        <td>".$row['category_name']."</td>
        <td>".$row['product_name']."</td>
        <td>".$row['product_price']."</td>
        <td>".$row['product_status']."</td>
    </tr>";
    $no++;
    }
    $html .= "</html>";
    $dompdf->loadHtml($html);
    // Setting ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'potrait');
    // Rendering dari HTML Ke PDF
    $dompdf->render();
    ob_end_clean();
    // Melakukan output file Pdf
    $dompdf->stream('Laporan Produk.pdf');
    exit;
?>