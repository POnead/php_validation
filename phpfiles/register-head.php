<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | CafeTrack</title>
  <link rel="stylesheet" href="style.css?v=3">
  <style>
    /* Critical fallback CSS — guarantees the layout works even if the external stylesheet fails to load */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; }
    body { background: #F7F6F3; color: #2B2B2B; }
    .split { display: flex; min-height: 100vh; }
    .brand { flex: 1 1 50%; min-width: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 48px 32px; background: linear-gradient(135deg, #9DBBA1 0%, #C7D6C3 60%, #F4EFE2 100%); }
    .brand h1 { font-size: 4rem; font-weight: 800; letter-spacing: -1px; }
    .brand p  { margin-top: 10px; font-size: 1.15rem; font-weight: 500; }
    .brand svg { margin-top: 56px; width: 230px; height: 177px; opacity: 0.85; flex-shrink: 0; }
    .form-side { flex: 1 1 50%; min-width: 0; display: flex; align-items: center; justify-content: center; padding: 48px 24px; }
    .card { width: 100%; max-width: 420px; }
    .card h2 { text-align: center; font-size: 1.9rem; margin-bottom: 30px; }
    .field { margin-bottom: 18px; }
    input { width: 100%; padding: 15px 24px; font-size: 1rem; color: #2B2B2B; background: #FCFCFA; border: 1px solid #9A9A9A; border-radius: 999px; outline: none; }
    input::placeholder { color: #8A8A8A; }
    input:focus { border-color: #6B8E70; box-shadow: 0 0 0 3px rgba(107, 142, 112, 0.18); }
    .btn { width: 100%; padding: 15px; margin-top: 8px; font-size: 1.05rem; font-weight: 700; color: #fff; background: #96603C; border: none; border-radius: 999px; cursor: pointer; }
    .btn:hover { background: #7A4B2C; }
    .links { margin-top: 20px; text-align: center; font-size: 0.95rem; color: #666; }
    .links a { color: #96603C; font-weight: 600; text-decoration: none; }
    .hint { list-style: none; margin-top: 8px; padding: 0 8px; font-size: 0.8rem; color: #666; }
    .hint li::before { content: "○ "; font-weight: 700; }
    .hint li.met { color: #2E7D32; }
    .hint li.met::before { content: "● "; }
    .alert-error { padding: 12px 16px; border-radius: 10px; font-size: 0.9rem; font-weight: 600; text-align: center; margin-bottom: 16px; background: #FDECEA; color: #C0392B; border: 1px solid #F5C6CB; }
    .alert-success { padding: 12px 16px; border-radius: 10px; font-size: 0.9rem; font-weight: 600; text-align: center; margin-bottom: 16px; background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
    .alert-success a { color: #2E7D32; font-weight: 700; }
    @media (max-width: 860px) {
      .split { flex-direction: column; }
      .brand { padding: 56px 24px 40px; }
      .brand h1 { font-size: 2.6rem; }
      .brand svg { width: 150px; height: 116px; margin-top: 28px; }
      .form-side { padding: 40px 20px 56px; }
    }
  </style>
