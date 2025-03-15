<h1>Link verifikasi telah dikirm</h1>
<form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <button type="submit">
        Resend Link Verifikasi
    </button>
</form>
