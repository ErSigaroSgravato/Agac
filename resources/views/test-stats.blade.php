<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>🎮 Agac - User Stats</title>
  <style>
    body { font-family: Arial; padding: 40px; background-color: #1a202c; color: white; }
    .card { background-color: #2d3748; padding: 20px; border-radius: 10px; width: 300px; }
    h1 { margin-bottom: 20px; }
    .loading { color: gray; }
  </style>
</head>
<body>
  <h1>User Stats</h1>
  <div class="card">
    <p><strong>Total Playtime:</strong> <span id="total-hours" class="loading">Loading...</span></p>
  </div>

  <script>
   async function getCsrfToken() {
  const response = await fetch("http://localhost:8000/sanctum/csrf-cookie", {
    method: "GET",
    credentials: "include"
  });
  return response.ok;
}

async function loginTestUser() {
  // First, get the CSRF token
  await getCsrfToken();

  // Then do login
  const response = await fetch("http://localhost:8000/login", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "include"
  });

  return response.ok;
}
  </script>
</body>
</html>