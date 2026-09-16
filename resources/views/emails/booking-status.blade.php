<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $booking->status === 'approved' ? 'Booking Disetujui' : 'Booking Ditolak' }}</title>
</head>

<body style="margin:0;padding:0;background-color:#f6f6f6;font-family:'Inter',Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f6f6f6;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;background-color:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #ececec;">
                    <tr>
                        <td style="background:linear-gradient(135deg,#d4a017,#b8860b);padding:24px 28px;">
                            <h1 style="margin:0;color:#ffffff;font-size:20px;font-weight:700;">Booking Budaya Brontokusuman</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 6px;color:#333333;font-size:15px;">Halo <strong>{{ $booking->nama }}</strong>,</p>
                            @if ($booking->status === 'approved')
                                <p style="margin:0 0 18px;color:#555555;font-size:14px;">Selamat! Booking Anda telah <strong style="color:#16a34a;">disetujui</strong>. Berikut detailnya:</p>
                            @else
                                <p style="margin:0 0 18px;color:#555555;font-size:14px;">Mohon maaf, booking Anda <strong style="color:#dc2626;">ditolak</strong>. Berikut detailnya:</p>
                            @endif

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#faf7ef;border-radius:12px;border:1px solid #efe6cf;margin-bottom:20px;">
                                <tr>
                                    <td style="padding:16px 20px;font-size:13px;color:#444444;line-height:1.7;">
                                        <strong>Budaya:</strong> {{ $booking->budaya->judul ?? '-' }}<br>
                                        <strong>Acara:</strong> {{ $booking->nama_acara }}<br>
                                        <strong>Tanggal:</strong> {{ $booking->tanggal_acara->translatedFormat('d F Y') }}<br>
                                        @if ($booking->lokasi_acara)
                                            <strong>Lokasi:</strong> {{ $booking->lokasi_acara }}<br>
                                        @endif
                                        <strong>Telepon:</strong> {{ $booking->telepon }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 20px;color:#555555;font-size:14px;line-height:1.7;">
                                Untuk informasi lebih lanjut mengenai booking, perubahan jadwal, atau hal lainnya, silakan menghubungi Admin {{ $booking->budaya->judul ?? 'Kampung Budaya Brontokusuman' }} melalui nomor berikut:<br>
                                <span style="font-size:16px;">&#128222; <strong style="color:#333333;">{{ $booking->budaya->no_telepon ?? '08965546215' }}</strong></span><br><br>
                                Admin kami akan membantu memberikan informasi lebih lanjut terkait booking Anda.
                            </p>

                            <p style="margin:0 0 4px;color:#888888;font-size:13px;">Salam hangat,</p>
                            <p style="margin:0;color:#b8860b;font-size:14px;font-weight:700;">Kampung Budaya Brontokusuman</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>