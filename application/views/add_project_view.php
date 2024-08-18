<!DOCTYPE html>
<html>

<head>
    <title>Tambah Proyek Baru</title>
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

        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin: 5px 0;
        }

        .form-container input,
        .form-container textarea,
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

        .form-container textarea {
            resize: vertical;
        }

        .back-button {
            display: block;
            width: max-content;
            margin: 20px auto 0 auto;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Proyek Baru</h1>

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

        <div class="form-container">
            <form action="<?php echo site_url('ProjectController/add_project'); ?>" method="post">
                <label for="namaProyek">Nama Proyek:</label>
                <input type="text" id="namaProyek" name="namaProyek" required>

                <label for="client">Client:</label>
                <input type="text" id="client" name="client" required>

                <label for="tglMulai">Tanggal Mulai:</label>
                <input type="date" id="tglMulai" name="tglMulai" required>

                <label for="tglSelesai">Tanggal Selesai:</label>
                <input type="date" id="tglSelesai" name="tglSelesai" required>

                <label for="pimpinanProyek">Pimpinan Proyek:</label>
                <input type="text" id="pimpinanProyek" name="pimpinanProyek" required>

                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" rows="4" required></textarea>

                <button type="submit">Tambah Proyek</button>
            </form>
        </div>
    </div>
</body>

</html>
