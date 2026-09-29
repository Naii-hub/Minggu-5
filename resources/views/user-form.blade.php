<!DOCTYPE html>
<html>
<head>
    <title>Form Validasi User</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;

            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            width: 400px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #555;
        }

        .submit-btn {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 6px;
            background: #222;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #444;
        }


        /* Popup Error */

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.5);

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            width: 380px;
            padding: 25px;
            border-radius: 10px;
        }

        .popup-content h3 {
            color: #d32f2f;
            margin-top: 0;
        }

        .popup-content li {
            margin-bottom: 8px;
        }

        .close-btn {
            width: 100%;
            margin-top: 15px;
            padding: 9px;
            border: none;
            border-radius: 6px;
            background: #d32f2f;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="card">

        <h2>Form Validasi User</h2>

        <p class="subtitle">
            Silakan isi data dengan benar
        </p>

        <form action="/submit" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama"
                >
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                >
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                >
            </div>

            <button type="submit" class="submit-btn">
                Submit
            </button>

        </form>

    </div>


    {{-- Popup Error --}}
    @if ($errors->any())

        <div class="popup" id="errorPopup">

            <div class="popup-content">

                <h3>⚠ Validasi Gagal</h3>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button
                    class="close-btn"
                    onclick="closePopup()"
                >
                    Tutup
                </button>

            </div>

        </div>

    @endif


    <script>
        function closePopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }
    </script>

</body>
</html>