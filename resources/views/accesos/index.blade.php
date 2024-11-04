<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
        /* Estilo del modal2 */
        .modal2 {
            display: none; /* Ocultar por defecto */
            position: fixed; /* Mantener en posición fija */
            z-index: 1000; /* Asegurarse que esté encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll si es necesario */
            background-color: rgba(0,0,0,0.4); /* Fondo con opacidad */
        }
    
        /* Estilo del contenido del modal2 */
        .modal2-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% desde la parte superior y centrado */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Podría ser un máximo de ancho */
            max-width: 600px; /* Limitar el ancho máximo */
            border-radius: 8px;
        }
    
        /* Estilo del botón de cerrar */
        .modal2-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    
        .modal2-close:hover,
        .modal2-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    
        /* Estilo de los inputs */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
    
        /* Estilo de los encabezados */
        h1, h5 {
            color: #333;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="contenedor-crud">
    <h1>Accesos</h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a class="btn btn-primary mb-3" id="accessCreateBtn">Crear Acceso</a>

    <table class="access-table1">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Clave de Acceso</th>
                <th>Fecha de Acceso</th>
                <th>Hora de Acceso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accesos as $acceso)
                <tr>
                    <td>{{ $acceso->cliente->name }}</td>
                    <td>{{ $acceso->clave_acceso }}</td>
                    <td>{{ $acceso->fecha_acceso }}</td>
                    <td>{{ $acceso->hora_acceso }}</td>
                    <td>
                        <form action="{{ route('accesos.destroy', $acceso) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal2 para ingresar clave de acceso --}}
    <div id="accessKeyModal2" class="modal2" style="display:none;">
        <div class="modal2-content">
            <span class="modal2-close" id="accessKeyCloseBtn">&times;</span>
            <h5>Ingrese Clave de Acceso</h5>
            <input type="text" id="access_key_input" placeholder="Clave de Acceso" style="margin-bottom: 15px">
            <a class="btn btn-warning" id="accessKeySearchBtn">Buscar</a>
        </div>
    </div>

    {{-- Modal2 para mostrar detalles del cliente --}}
    <div id="clientDetailsModal2" class="modal2" style="display:none;">
        <div class="modal2-content">
            <span class="modal2-close" id="clientDetailsCloseBtn">&times;</span>
            <h5>Detalles del Cliente</h5>
            <p><strong>Nombre:</strong> <span id="client_name"></span></p>
            <p><strong>Teléfono:</strong> <span id="client_phone"></span></p>
            <p><strong>Dirección:</strong> <span id="client_address"></span></p>
            <p><strong>Estado:</strong> <span id="client_status"></span></p>
            <button id="accessCreateModal2Btn">Crear Acceso</button>
            <button id="clientDetailsClose">Cerrar</button>
        </div>
    </div>
</div>

@endsection

<script>
    let clienteId; // Variable global para almacenar el ID del cliente
    let claveAcceso; // Variable global para almacenar la clave de acceso

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('accessCreateBtn').addEventListener('click', function() {
            document.getElementById('accessKeyModal2').style.display = 'block';
        });

        document.getElementById('accessKeyCloseBtn').addEventListener('click', function() {
            document.getElementById('accessKeyModal2').style.display = 'none';
        });

        document.getElementById('accessKeySearchBtn').addEventListener('click', function() {
            claveAcceso = document.getElementById('access_key_input').value;
            fetch(`/accesos/buscar-cliente`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ clave_acceso: claveAcceso })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    clienteId = data.cliente.id; // Almacena el ID del cliente
                    document.getElementById('client_name').innerText = data.cliente.name;
                    document.getElementById('client_phone').innerText = data.cliente.telefono || 'N/A';
                    document.getElementById('client_address').innerText = data.cliente.direccion || 'N/A';
                    document.getElementById('client_status').innerText = data.estado === 'activo' ? 'Con Paquete' : 'Sin Paquete';
                    document.getElementById('clientDetailsModal2').style.display = 'block';
                    document.getElementById('accessKeyModal2').style.display = 'none';
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('clientDetailsCloseBtn').addEventListener('click', function() {
            document.getElementById('clientDetailsModal2').style.display = 'none';
        });

        // Este es el código para crear el acceso
        document.getElementById('accessCreateModal2Btn').addEventListener('click', function() {
            if (!clienteId || !claveAcceso) {
                alert('Faltan datos del cliente o clave de acceso.');
                return;
            }

            fetch(`/accesos`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cliente_id: clienteId,
                    clave_acceso: claveAcceso
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualiza la tabla con el nuevo acceso
                    const newRow = `
                        <tr>
                            <td>${data.cliente.name}</td>
                            <td>${data.acceso.clave_acceso}</td>
                            <td>${data.acceso.fecha_acceso}</td>
                            <td>${data.acceso.hora_acceso}</td>
                            <td>
                                <form action="/accesos/${data.acceso.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="access-button1-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>`;
                    document.querySelector('.access-table1 tbody').insertAdjacentHTML('beforeend', newRow);

                    // Cierra el modal de detalles
                    document.getElementById('clientDetailsModal2').style.display = 'none';
                    alert('Acceso creado exitosamente.');
                } else {
                    alert('Hubo un problema al crear el acceso.');
                }
            });
        });

        // Cerrar el modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('accessKeyModal2');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    });
</script>

</body>
</html>
