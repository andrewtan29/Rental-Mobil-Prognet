<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nota Transaksi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      border: 1px solid #ddd;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .details {
      margin-bottom: 20px;
    }

    .details table {
      width: 100%;
      border-collapse: collapse;
    }

    .details table td {
      padding: 5px;
    }

    .footer {
      text-align: center;
      margin-top: 30px;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header" style="display: flex; justify-content: space-between;">
      <div>
        <img src="{{ public_path('images/car-rent-logo.png') }}" alt="Logo" width="100">
      </div>
      <div>
        <h2>Nota Transaksi Penyewaan Mobil</h2>
        <p>PT. Rentcar Kelompok 1</p>

        <hr>

        <div>
          <p>Kode Transaksi: <strong>{{ $transaksi->kode_transaksi }}</strong></p>
          <p>Dibuat pada {{ $transaksi->created_at }}</p>
        </div>
      </div>
    </div>

    <div class="details">
      <h3>Detail Transaksi</h3>
      <table>
        <tr>
          <td><strong>Nama Pelanggan</strong></td>
          <td>{{ $transaksi->pelanggan['nama'] }}</td>
        </tr>
        <tr>
          <td><strong>Alamat Pelanggan</strong></td>
          <td>{{ $transaksi->pelanggan['alamat'] }}</td>
        </tr>
        <tr>
          <td><strong>No HP</strong></td>
          <td>{{ $transaksi->pelanggan['no_hp'] }}</td>
        </tr>
        <tr>
          <td><strong>Nama Mobil</strong></td>
          <td>{{ $transaksi->mobil['nama'] }}</td>
        </tr>
        <tr>
          <td><strong>Plat Nomor</strong></td>
          <td>{{ $transaksi->mobil['plat_nomor'] }}</td>
        </tr>
        <tr>
          <td><strong>Tanggal Sewa</strong></td>
          <td>{{ $transaksi->tanggal_sewa }}</td>
        </tr>
        <tr>
          <td><strong>Tanggal Kembali</strong></td>
          <td>{{ $transaksi->tanggal_kembali }}</td>
        </tr>
        <tr>
          <td><strong>Harga Sewa / Hari</strong></td>
          <td>Rp {{ number_format($transaksi->harga_sewa, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td><strong>Total Harga</strong></td>
          <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td><strong>Status Transaksi</strong></td>
          <td>{{ $transaksi->status_transaksi }}</td>
        </tr>
      </table>
    </div>

    <div class="footer">
      <p>Terima kasih telah menggunakan layanan kami!</p>
    </div>
  </div>
</body>

</html>
