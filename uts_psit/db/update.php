<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Nilai Mahasiswa</title>
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
  .btn-update {
    background-color: #4caf50;
    color: #fff;
    border: none;
  }
</style>
</head>
<body>

<div class="container">
  <h2 class="text-2xl font-bold mb-4">Update Nilai Mahasiswa</h2>

  <form id="updateForm">
    <div class="form-group">
      <label for="nilai">Nilai:</label>
      <input type="text" id="nilai" name="nilai" required>
    </div>
    <button type="submit" class="btn-update">Update Nilai</button>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const nim = urlParams.get('nim');
    const kode_mk = urlParams.get('kode_mk');

    // Add event listener for form submission
    document.getElementById('updateForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      const nilai = document.getElementById('nilai').value;
      
      if (!nim || !kode_mk) {
        alert('NIM or Kode MK is missing.');
        return;
      }

      fetch(`http://localhost/UTS_PSIT/db/mahasiwado.php`, {
        method: 'PUT',
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
        alert(data.message);
        window.location.href = 'http://localhost/UTS_PSIT/db/index.php'; // Redirect to index page
      })
      .catch(error => console.error('Error updating data:', error));
    });
  });
</script>

</body>
</html>
