<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .details-table th {
            background-color: #f8f8f8;
            font-weight: bold;
            width: 30%;
        }

        .section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .attachment-image {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Laporan Pengaduan</h1>
        <table class="details-table">
            <tr>
                <th>ID Laporan</th>
                <td>{{ $complaint->id }}</td>
            </tr>
            <tr>
                <th>Judul Laporan</th>
                <td>{{ $complaint->title }}</td>
            </tr>
            <tr>
                <th>Kategori Laporan</th>
                <td>{{ $complaint->report_category }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ \Carbon\Carbon::parse($complaint->incident_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Instansi Tujuan</th>
                @if ($complaint->agency)
                    <td>{{ $complaint->agency->name }}</td>
                @else
                    <td>{{ $complaint->new_agency }}</td>
                @endif

            </tr>
            <tr>
                <th>Nomor Telepon Pelapor</th>
                <td>{{ $complaint->phone_number }}</td>
            </tr>
        </table>

        <div class="section">
            <h2 class="section-title">Isi Laporan</h2>
            <p>{{ $complaint->description }}</p>
        </div>

        {{-- Logic to check for and embed the image --}}
        @php
            $imagePath = null;
            if ($complaint->identity_photo) {
                // Get the full server path to the file in the public storage disk
                $fullPath = storage_path('app/public/' . $complaint->identity_photo);

                // Check if the file exists and is an image
                if (file_exists($fullPath)) {
                    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                        $imagePath = $fullPath;
                    }
                }
            }
        @endphp

        @if ($imagePath)
            <div class="section">
                <h2 class="section-title">KTP</h2>
                {{-- Embed the image using its full server path --}}
                <img src="{{ $imagePath }}" class="attachment-image">
            </div>
        @endif
    </div>
</body>

</html>
