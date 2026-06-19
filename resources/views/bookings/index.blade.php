{{--
  bookings/index.blade.php
  Riwayat Booking telah dipindahkan ke dalam dashboard akun (profile.edit?tab=bookings).
  Halaman ini me-redirect agar tidak ada dead-link dari bookmark/email lama.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url={{ route('profile.edit', ['tab' => 'bookings']) }}">
    <title>Mengalihkan…</title>
</head>
<body>
    <p>Mengalihkan ke <a href="{{ route('profile.edit', ['tab' => 'bookings']) }}">Riwayat Booking</a>…</p>
</body>
</html>
