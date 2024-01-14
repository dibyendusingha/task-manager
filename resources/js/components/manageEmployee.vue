<template>
  <div class="wrapper">
    <navbar/>
    <sidebar mainMenu='chamber'/>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-6 col-sm-6">
              <h1 class="m-0 text-primary text-bold">Manage Employee</h1>
            </div><!-- /.col -->
            <div class="col-6 col-sm-6">
              <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item active">Manage Employee</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="accordion" id="accordionExample">
              <div class="card">
              <div class="card-header bg-gradient-primary">
                <div class="row">
                  <div class="col-2 my-auto">
                    <h3 class="card-title mb-2">Search By:</h3>
                  </div>
                  <div class="col-3 my-auto px-1">
                    <div class="form-group mb-0">
                      <input class="form-control form-control-sm mb-1" type="text" v-model="filterFrom.name" placeholder="Employee Name">
                    </div>
                  </div>
                  <div class="col-5 px-1">
                    <div class="row">
                      <div class="col-2 pr-1">
                        <button type="submit" @click="filterData()" class="btn btn-sm btn-block bg-gradient-warning"><i class="fa fa-search"></i>Search</button>
                      </div>
                      <div class="col-2 px-1">
                        <button type="button" @click="clearForm" class="btn btn-sm btn-block bg-gradient-dark"><i class="fa fa-undo"></i></button>
                      </div>
                      <div class="col-4 pl-1">
                        <router-link to="/add-employee" class="btn btn-sm btn-block bg-gradient-success" type="button"  ><i class="fa fa-plus-circle"></i> Add Employee</router-link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">     
              <div class="card-body p-0">
                <div class="table-responsive table-hover">
                  <table class="table text-nowrap mb-0">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Employee Name</th>
                        <th>Contact No.</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-md">
                      <tr v-for="(eachData,index) in allEmployeeList" :key="index"  v-if="allEmployeeList != ''">
                        <td>{{index+1}}</td>
                        <td>{{eachData.name}}</td>
                        <td>{{eachData.contactNo}}</td>
                        <td v-if="eachData.status== 1" class="btn btn-success">Active</td>
                        <td v-if="eachData.status== 0" class="btn btn-danger">Inactive</td>
                       
                        
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu" style="" >
                                <a href="javascript:void(0);"  @click="getAEmployeeDetails(eachData.id)" class="dropdown-item" data-toggle="modal" :data-target="'#edit-chamber'+index" >Edit</a>
                                <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" :data-target="'#delete-confirm'+index">Delete</a>
                            </div>
                          </div>

                          <!-- Edit Chamber Modal -->
                          <form v-on:submit.prevent="saveEmp">
                            <div class="modal fade rms-modal" data-backdrop="static" data-keyboard="false" :id="'edit-chamber'+index">
                              <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content text-left">
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-7 col-md-3">
                                          <div class="form-group">
                                              <input type="hidden" v-model="editForm.EmpId" />
                                              <label class="text-grey"> Employee Name <span class="text-danger">*</span></label>
                                              <input type="text" v-model="editForm.name" class="form-control form-control-sm" required>
                                          </div>
                                      </div>
                                      <div class="col-7 col-md-3">
                                        <div class="form-group">
                                            <label class="text-grey">Contact No <span class="text-danger">*</span></label>
                                            <textarea name="" id="" rows="3" v-model="editForm.contactNo" class="form-control form-control-sm" required></textarea>
                                        </div>
                                      </div>
                                      <div class="col-7 col-md-3">
                                        <div class="form-group">
                                          <label class="text-grey">Status</label>
                                          <!-- <input type="text" v-model="editForm.contactPerson" class="form-control form-control-sm"> -->
                                          <select class="form-control form-control-sm" v-model="editForm.status" required>
                                            <option value="" selected>-- select --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-4 offset-2 col-md-2 my-auto">
                                        <button class="btn bg-gradient-danger btn-sm btn-block mt-2" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Discard</button>
                                      </div>
                                      <div class="col-4 col-md-2 my-auto">
                                        <button class="btn bg-gradient-primary btn-sm btn-block mt-2" type="submit"><i class="fa fa-check-circle"></i> Save Changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                          <!-- Edit Chamber Modal -->

                          <!-- Delete Confirm Modal -->
                          <div class="modal fade rms-modal" data-backdrop="static" data-keyboard="false" :id="'delete-confirm'+index" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-12 mb-3">
                                      <button class="btn bg-gradient-danger btn-block btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> No, Cancel</button>
                                    </div>
                                    <div class="col-12">
                                      <button @click="delEmployee(eachData.id)" class="btn bg-gradient-primary btn-block btn-sm" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Yes, Delete</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Delete Confirm Modal -->

                        </td>
                      </tr>
                      <tr v-else>
                        <td colspan="13" style="text-align:center; color:red;font-size: 30px;">
                          <h2 style="margin-top:40px;">No Data Found !</h2>
                        </td>
                    </tr>
                    </tbody>
                  </table>
                  <div class="p-5" v-if="searchPagination == false" >
                  <pagination v-if="pagination.last_page > 1"
                      :pagination="pagination"
                      :offset="10"
                      @paginate="getAllEmployee()">
                  </pagination>
                </div>
                <div class="p-5" v-else>
                  <pagination v-if="pagination.last_page > 1"
                      :pagination="pagination"
                      :offset="10"
                      @paginate="filterData()">
                  </pagination>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
import Sidebar from './layout/sidebar.vue';
import Navbar from './layout/navbar.vue';
import Api    from '../src/Api.js';
import Chowkidar from '../src/Chowkidar.js'
import Pagination from '../src/Pagination.vue'

export default {
  components:{
    'sidebar':Sidebar,
    'navbar':Navbar,
    'pagination':Pagination
  },
  data(){
    return{
      pagination:{
      current_page:1,
      },

      searchPagination : false,
      isLoading : false,

      filterFrom:{
       name:""
      },

      editForm:{
        name:'',
        contactNo  :'',
        jobTitle:'',
        status : '',
        EmpId:''
      },

      allEmployeeList:{},
    }
  },
  methods:{

    resetForm(){
      this.form = {
        chamberName:'',
        address:'',
        contactNo:'',
        contactPerson:'',
        email:'',
        EmpId:''
      }
    },

    saveEmp(){
      if(this.editForm.EmpId == '')
      {
        
      }
      else{
        Api().post('/edit-the-employee/',this.editForm)
          .then(response =>{
            if(response.data['success'] == true){
              this.getAllEmployee();
              this.$swal({
                icon: 'success',
                title: ' '+response.data['msg'],
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
              });
            }else{
              this.$swal({
                icon: 'error',
                title: ' '+response.data['msg'],
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
              });
            }
          })
      }
    },

    delEmployee(employeeId){
      Api().get('/delete-a-employee/'+employeeId)
        .then(response =>{
          if(response.data['success'] == true){
            this.getAllEmployee();
            this.$swal({
              icon: 'warning',
              title: ' '+response.data['msg'],
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 4000
            });
          }
        })
    },

    getAEmployeeDetails(employeeId){
      Api().get('/get-a-employee-details/'+employeeId)
        .then(response =>{
          this.editForm ={
            name: response.data.name,
            contactNo : response.data.contactNo ,
            jobTitle: response.data.jobTitle,
            status: response.data.status,
            EmpId: response.data.id
          }
        })
    },

    getAllEmployee(){
      this.searchPagination = false;
      this.isLoading = true;
      Api().get('/all-employee-list?page='+this.pagination.current_page)
        .then(response =>{
          //this.allEmployeeList = response.data;
          if(response.data == null)
          {
            this.isLoading = true;
          }
          else
          { 
            this.isLoading  = false;
            this.pagination = response.data.meta;
            this.allEmployeeList = response.data.data;
          }
        })
    },
    
    filterData(){
      this.searchPagination = true;
      Api().post('/filter-employee?page='+this.pagination.current_page,this.filterFrom)
        .then(response =>{
          if(response.data == null)
          {
            this.isLoading = true;
          }
          else
          { 
            this.isLoading  = false;
            this.pagination = response.data.meta;
            this.allEmployeeList = response.data.data;
          }
        })
    },
      
    clearForm(){
      this.filterFrom
      this.filterFrom.name   = '';
      this.getAllEmployee();

    }

  },
  created(){
    if(Chowkidar() == 'web')
    {
      this.getAllEmployee();
      this.phone  = localStorage.getItem('contactno');
      this.roleid = localStorage.getItem('roleid');
    }else{
      this.$router.push('/login');
    }
  }
}
</script> 