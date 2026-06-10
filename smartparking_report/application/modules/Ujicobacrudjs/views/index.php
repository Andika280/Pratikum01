<!DOCTYPE html>
<html>
<head>
    <title>CRUD AJAX</title>
</head>
<body>

    <h2>CRUD AJAX</h2>    
    <button onclick="tambah_data()">Tambah Data</button>
    <br><br>

    <table border="1" width="100%" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="data_ujicobacrudjs">
            <tr>
                <td colspan="4" align="center">Memuat data...</td>
            </tr>
        </tbody>
    </table>

    <hr>

    <div id="form_container" style="display:none;">
        <h3 id="form_title">Form Ujicobacrudjs</h3>
        <form id="form_ujicobacrudjs">
            <input type="hidden" name="id" id="id">
            
            <label>Nama:</label><br>
            <input type="text" name="nama" id="nama" required><br><br>
            
            <label>Keterangan:</label><br>
            <textarea name="keterangan" id="keterangan" rows="4" cols="30"></textarea><br><br>
            
            <button type="button" onclick="simpan_data()">Simpan</button>
            <button type="button" onclick="batal()">Batal</button>
        </form>
    </div>

    <script>
        var save_method;
        var base_url = "<?php echo base_url('Ujicobacrudjs/'); ?>";

        muat_data();

        function muat_data() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", base_url + "get_data", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    var html = "";
                    
                    if(data.length === 0) {
                        html = "<tr><td colspan='4' align='center'>Data masih kosong</td></tr>";
                    } else {
                        for (var i = 0; i < data.length; i++) {
                            html += "<tr>";
                            html += "<td>" + (i+1) + "</td>";
                            html += "<td>" + data[i].nama + "</td>";
                            html += "<td>" + data[i].keterangan + "</td>";
                            html += "<td>";
                            html += "<button onclick='ubah_data(" + data[i].id + ")'>Ubah</button> ";
                            html += "<button onclick='hapus_data(" + data[i].id + ")'>Hapus</button>";
                            html += "</td>";
                            html += "</tr>";
                        }
                    }
                    document.getElementById("data_ujicobacrudjs").innerHTML = html;
                }
            };
            xhr.send();
        }

        function tambah_data() {
            save_method = 'tambah';
            document.getElementById("form_ujicobacrudjs").reset();
            document.getElementById("id").value = "";
            document.getElementById("form_title").innerText = "Tambah Data Baru";
            document.getElementById("form_container").style.display = "block";
        }

        function ubah_data(id) {
            save_method = 'ubah';
            document.getElementById("form_ujicobacrudjs").reset();
            
            var xhr = new XMLHttpRequest();
            xhr.open("GET", base_url + "get_by_id/" + id, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    
                    document.getElementById("id").value = data.id;
                    document.getElementById("nama").value = data.nama;
                    document.getElementById("keterangan").value = data.keterangan;
                    
                    document.getElementById("form_title").innerText = "Ubah Data";
                    document.getElementById("form_container").style.display = "block";
                }
            };
            xhr.send();
        }

        function batal() {
            document.getElementById("form_container").style.display = "none";
        }

        function simpan_data() {
            var url;
            if (save_method == 'tambah') {
                url = base_url + "tambah";
            } else {
                url = base_url + "ubah";
            }

            var form = document.getElementById("form_ujicobacrudjs");
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status) {
                        alert("Data berhasil disimpan!");
                        batal();
                        muat_data();
                    }
                }
            };
            xhr.send(formData);
        }

        function hapus_data(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", base_url + "hapus/" + id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status) {
                            alert("Data berhasil dihapus!");
                            muat_data();
                        }
                    }
                };
                xhr.send();
            }
        }
    </script>
</body>
</html>
