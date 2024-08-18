<!DOCTYPE html>
<html>

<head>
    <title>Data Proyek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            font-size: 14px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td {
            vertical-align: middle;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container label {
            margin: 5px 0;
        }

        .form-container input,
        .form-container button {
            padding: 8px;
            margin: 5px 0;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .add-project-button {
            display: block;
            width: max-content;
            margin: 0 auto 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-project-button:hover {
            background-color: #45a049;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .actions a,
        .actions form button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .actions a {
            background-color: #4CAF50;
        }

        .actions a:hover {
            background-color: #45a049;
        }

        .actions form button {
            background-color: red;
        }

        .actions form button:hover {
            background-color: darkred;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .table {
                font-size: 12px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .actions a,
            .actions form button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Proyek</h1>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert">
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message['success'])) {
                    echo '<p style="color: green;">' . htmlspecialchars($message['success']) . '</p>';
                } elseif (isset($message['error'])) {
                    echo '<p style="color: red;">' . htmlspecialchars($message['error']) . '</p>';
                }
                ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo site_url('ProjectController/show_add_project_form'); ?>" class="add-project-button">Tambah Proyek</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Proyek</th>
                    <th>Client</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Pimpinan Proyek</th>
                    <th>Keterangan</th>
                    <th>Lokasi</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['id']); ?></td>
                            <td><?php echo htmlspecialchars($project['namaProyek']); ?></td>
                            <td><?php echo htmlspecialchars($project['client']); ?></td>
                            <td><?php echo htmlspecialchars($project['tglMulai']); ?></td>
                            <td><?php echo htmlspecialchars($project['tglSelesai']); ?></td>
                            <td><?php echo htmlspecialchars($project['pimpinanProyek']); ?></td>
                            <td><?php echo htmlspecialchars($project['keterangan']); ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($project['proyekLokasiList'] as $lokasi): ?>
                                        <li><?php echo htmlspecialchars($lokasi['lokasi']['namaLokasi']) . ' (' . htmlspecialchars($lokasi['lokasi']['kota']) . ', ' . htmlspecialchars($lokasi['lokasi']['provinsi']) . ')'; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?php echo htmlspecialchars($project['createdAt']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="<?php echo site_url('ProyekController/edit_project/' . $project['id']); ?>">Update</a>
                                    <form action="<?php echo site_url('ProjectController/delete_project/' . $project['id']); ?>" method="post" style="display:inline;">
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Tidak ada data tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
