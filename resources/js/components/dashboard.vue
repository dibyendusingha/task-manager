<template>
  <div class="wrapper">
    <navbar/>
    <sidebar mainMenu='dashboard'/>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-primary text-bold">Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
            <div class="col-4 col-lg-2" v-if="this.roleid == 1">
              <!-- small box -->
                <div class="small-box bg-gradient-primary">
                  <div class="inner">
                    <h6>Total Task</h6>
                    <h3>{{dashboard.task}}</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-nurse fa-2x" style="font-size:40px"></i>
                  </div>
                </div>
            </div>
            
            <div class="col-4 col-lg-2" v-else-if="this.roleid == 2">
              <!-- small box -->
                <div class="small-box bg-gradient-primary">
                  <div class="inner">
                    <h6>My Total Task</h6>
                    <h3>{{userdashboard.task}}</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-nurse fa-2x" style="font-size:40px"></i>
                  </div>
                </div>
            </div>
            <div class="col-4 col-lg-2" v-if="this.roleid == 2">
              <!-- small box -->
                <div class="small-box bg-gradient-primary">
                  <div class="inner">
                    <h6>My Active Task</h6>
                    <h3>{{userdashboard.activetask}}</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-nurse fa-2x" style="font-size:40px"></i>
                  </div>
                </div>
            </div>
            <div class="col-4 col-lg-2" v-if="this.roleid == 2">
              <!-- small box -->
                <div class="small-box bg-gradient-primary">
                  <div class="inner">
                    <h6>My Inactive Task</h6>
                    <h3>{{userdashboard.inactivetask}}</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-nurse fa-2x" style="font-size:40px"></i>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.row -->
         
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</template>

<script>
import Api     from '../src/Api.js';
import Sidebar from './layout/sidebar.vue'
import Navbar from './layout/navbar.vue'
import Chowkidar from '../src/Chowkidar.js'

export default {
  components:{
    'sidebar':Sidebar,
    'navbar':Navbar
  },
  
  data(){
    return{
      dashboard:{
       task:''
      },

      userdashboard:{
       task:'',
       activetask:'',
       inactivetask:''
      },
      roleId:"",
      patList:{},
      chooseBy:'Appointment'
    }
  },
  
  methods:{
    getDashboardList(){
      Api().get('/dashboard-card-data')
        .then(response =>{
          this.dashboard = {
            task: response.data.task
            
          }
          console.log(response.data);
        })
    },

    getUserDashboardList(){
      this.phone  = localStorage.getItem('contactno');
      Api().get('/user-dashboard-card-data/'+this.phone)
        .then(response =>{
          this.userdashboard = {
            task: response.data.task,
            activetask: response.data.activetask,
            inactivetask: response.data.inactivetask,
          }
          console.log(response.data);
        })
    },


  },
  created(){
    if(Chowkidar() == 'web')
    {
      this.getDashboardList();
      this.getUserDashboardList();
      this.phone  = localStorage.getItem('contactno');
      this.roleid = localStorage.getItem('roleid');
     
    }else{
      this.$router.push('/login');
    }
  }
}
</script>