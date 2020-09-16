<template>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :to="{name: 'admin-add-role' }">Role</router-link>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Speciality</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Hero</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Perhitungan Electre</a>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>

export default {
    components: {
        
    }
}
</script>