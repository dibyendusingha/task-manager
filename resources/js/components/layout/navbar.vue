<template>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
  
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
  
        <!-- Logout Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-power-off"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-item">
              <!-- Logout Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Hi, {{ this.name }} 
                  </h3>
                 
                  <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-sm btn-danger mt-2">Log Out</button>
                </div>
              </div>
              <!-- Logout End -->
            </div>
          </div>
        </li>
      </ul>
    </nav>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true" data-backdrop="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure want to logout ?
          </div>
          <div class="modal-footer">
            <button type="submit" @click="logout" class="btn btn-danger">Logout</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <!-- /.navbar -->
</template>

<script>
  import Api from '../../src/Api.js';
export default {
  data(){
    return{

      name:"",
     
    }
  },
  methods:{
      async logout()
      {
        localStorage.removeItem('token');
        localStorage.removeItem('guard');
          Api().post('/logout')
              .then((response)=>{
                  if(response.data['success'] == true)
                  {
                    this.$router.push({
                      name : 'user-login'
                    });
                  }
              });
      },

      async authChk()
      {
          if(localStorage.getItem('token') == null)
          {
            this.$router.push({
              name : 'user-login'
            });
          }
      },
  },

  created()
  {
    this.authChk();

    this.name = localStorage.getItem('name');
  }
  
}
</script>