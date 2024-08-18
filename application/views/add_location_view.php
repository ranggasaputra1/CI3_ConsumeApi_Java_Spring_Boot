<!DOCTYPE html>
<html>

<head>
    <title>Tambah Lokasi</title>
    <style>
        /* CSS untuk tampilan print */
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

        .alert {
            color: green;
            font-weight: bold;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Lokasi</h1>

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

        <!-- Formulir untuk menambah data -->
        <div class="form-container">
            <form action="<?php echo site_url('HomeController/add_location'); ?>" method="post">
                <label for="namaLokasi">Nama Lokasi:</label>
                <input type="text" id="namaLokasi" name="namaLokasi" required>

                <label for="negara">Negara:</label>
                <input type="text" id="negara" name="negara" required>

                <label for="provinsi">Provinsi:</label>
                <input type="text" id="provinsi" name="provinsi" required>

                <label for="kota">Kota:</label>
                <input type="text" id="kota" name="kota" required>

                <label for="createdAt">Created At:</label>
                <input type="datetime-local" name="createdAt" id="createdAt">

                <button type="submit">Tambah Lokasi</button>
            </form>
        </div>
    </div>
</body>

</html>
