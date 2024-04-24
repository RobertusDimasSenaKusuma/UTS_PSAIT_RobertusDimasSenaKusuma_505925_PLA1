<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Nilai Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f4f6;
  }
  .container {
    width: 80%;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    padding: 20px;
  }
  .form-group {
    margin-bottom: 1rem;
  }
  label {
    display: block;
    margin-bottom: 0.5rem;
  }
  input[type="text"] {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
  }
  button {
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
  }
  .btn-insert {
    background-color: #2196f3;
    color: #fff;
    border: none;
  }
</style>
</head>
<body>

<div class="container">
  <h2 class="text-2xl font-bold mb-4">Insert Nilai Mahasiswa</h2>

  <form id="insertForm">
    <div class="form-group">
      <label for="nim">NIM:</label>
      <input type="text" id="nim" name="nim" required>
    </div>
    <div class="form-group">
      <label for="kode_mk">Kode MK:</label>
      <input type="text" id="kode_mk" name="kode_mk" required>
    </div>
    <div class="form-group">
      <label for="nilai">Nilai:</label>
      <input type="text" id="nilai" name="nilai" required>
    </div>
    <button type="submit" class="btn-insert">Insert Nilai</button>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const insertForm = document.getElementById('insertForm');

    insertForm.addEventListener('submit', function(event) {
      event.preventDefault();
      
      const nim = document.getElementById('nim').value;
      const kode_mk = document.getElementById('kode_mk').value;
      const nilai = document.getElementById('nilai').value;
      
      fetch('http://localhost/UTS_PSIT/db/mahasiwado.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          nim: nim,
          kode_mk: kode_mk,
          nilai: nilai
        })
      })
      .then(response => response.json())
      .then(data => {
        alert(data.success ? data.message : data.error);
        if (data.success) {
          window.location.href = 'index.php'; // Redirect to index page
        }
      })
      .catch(error => console.error('Error adding data:', error));
    });
  });
</script>

</body>
</html>
