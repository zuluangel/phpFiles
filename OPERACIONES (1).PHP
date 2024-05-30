<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nominasistemas3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear un empleado
if(isset($_POST['create'])) {
    $nombres = $_POST['nombres'];
    $apellido = $_POST['apellido'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $genero = $_POST['genero'];
    $estado = $_POST['estado'];
    $departamento = $_POST['departamento'];
    $salario = $_POST['salario'];
    $area = $_POST['area'];
    $estado_civil = $_POST['estado_civil'];
    
    $sql = "INSERT INTO empleados (nombre, apellido, tipo_documento, numero_documento, genero, estado, departamento, salario, area, estado_civil) VALUES ('$nombre', '$apellido', '$tipo_documento', '$numero_documento', '$genero', '$estado', '$departamento', '$salario', '$area', '$estado_civil')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Empleado creado correctamente";
    } else {
        echo "Error al crear el empleado: " . $conn->error;
    }
}

// Cargar Empleados
$sql = "call obtener_empleados";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>Tipo de Documento</th><th>Número de Documento</th><th>Género</th><th>Estado</th><th>Departamento</th><th>Salario</th><th>Área</th><th>Estado Civil</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["nombres"]."</td>";
        echo "<td>".$row["apellido"]."</td>";
        echo "<td>".$row["cod-tipodoc"]."</td>";
        echo "<td>".$row["num-documento"]."</td>";
        echo "<td>".$row["cod-genero"]."</td>";
        echo "<td>".$row["cod-estado"]."</td>";
        echo "<td>".$row["cod-municipio"]."</td>";
        echo "<td>".$row["salario"]."</td>";
        echo "<td>".$row["cod-area"]."</td>";
        echo "<td>".$row["cod-estcivil"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay empleados";
}

// Borrar empleado
if(isset($_POST['delete'])) {
    $id = $_POST['id_eliminar'];
    
    $sql = "DELETE FROM empleados WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Empleado eliminado correctamente";
    } else {
        echo "Error al eliminar el empleado: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Empleados</title>
</head>
<body>
    <h2>Crear Empleado</h2>
    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Apellido:</label>
        <input type="text" name="apellido" required><br>
        <label>Tipo de Documento:</label>
        <input type="text" name="tipo_documento" required><br>
        <label>Número de Documento:</label>
        <input type="text" name="numero_documento" required><br>
        <label>Género:</label>
        <input type="text" name="genero" required><br>
        <label>Estado:</label>
        <input type="text" name="estado" required><br>
        <label>Departamento:</label>
        <input type="text" name="departamento" required><br>
        <label>Salario:</label>
        <input type="text" name="salario" required><br>
        <label>Área:</label>
        <input type="text" name="area" required><br>
        <label>Estado Civil:</label>
        <input type="text" name="estado_civil" required><br>
        <button type="submit" name="create">Crear</button>
    </form>

    <h2>Eliminar Empleado</h2>
    <form method="post">
        <label>ID del Empleado a Eliminar:</label>
        <input type="text" name="id_eliminar" required><br>
        <button type="submit" name="delete">Eliminar</button>
    </form>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>

