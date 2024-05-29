@extends('master')

@section('content')

<style>

    .container-fluid {
        border-radius: 20px;
    }

    .eye-toggle {
        cursor: pointer;
        position: absolute;
        right: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        transition: color 0.3s;
    }

    .eye-toggle:hover {
        color: #333; 
    }

    .eye-toggle.fa-eye-slash {
        color: #3498db;
    }
</style>

<div class="container-fluid">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <div class="usuarios">
              <h2 class="titulo-usuarios">Crear usuario</h2>
          </div>
          <form method='POST' action="{{  route('users.store')  }}">
              @csrf 
              <div class="mb-3 row">
                  <label for="inputName" class="col-4 col-form-label">Nombre: </label>
                  <div class="col-6">
                      <input type="name" class="form-control" name="name" id="name" placeholder="Nombre" required>
                  </div>

                  <label for="inputSurname" class="col-4 col-form-label">Apellido: </label>
                  <div class="col-6">
                      <input type="surname" class="form-control" name="surname" id="surname" placeholder="Apellido" required>
                  </div>

                  <label for="inputEmail" class="col-4 col-form-label">Email: </label>
                  <div class="col-6">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>

                  <label for="inputPassword" class="col-4 col-form-label">Contraseña: </label>
                  <div class="col-6 position-relative">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                      <span toggle="#password" class="eye-toggle fa fa-eye"></span>
                  </div>

                  <label for="inputPost" class="col-4 col-form-label">Cargo: </label>
                  <div class="col-6">
                      <select class="form-control" name="post" id="post" required>
                          <option value="2">Usuario</option>
                          <option value="1">Admin</option>
                      </select>
                  </div>
              </div>
              <div class="mb-3 row">
                  <div class="offset-sm-4 col-sm-8">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const eyeToggle = document.querySelector('.eye-toggle');
    eyeToggle.addEventListener('click', function () {
        const target = document.querySelector(this.getAttribute('toggle'));
        const icon = this.classList.contains('fa-eye') ? 'fa-eye-slash' : 'fa-eye';
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        target.type = target.type === 'password' ? 'text' : 'password';
    });
});
</script>

@endsection
