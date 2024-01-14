<template>
  <div class="login-page">
    <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Task Management -</b> System</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form @submit.prevent="login">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" v-model="form.email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" v-model="form.password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button class="btn btn-info btn-block btn-sm" type="submit">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
    </div>

  </div>
     
</template>

<script>
  import axios from 'axios';

  export default {
      data(){
          return {
              form:
              {
                  email:"",
                  password:""
              },
              token:''
          }
      },
      methods:
      {
          async login()
          {
            console.log("inside login");
            
              axios.post('/api/login',this.form)
                   .then((response) =>{
                    if(response.data['success'] == true)
                    {
                      console.log('success');

                        this.token = response.data['token'];
                        this.$router.push('/');/** dashboard */
                        localStorage.setItem('token',response.data['token']);
                        localStorage.setItem('guard',response.data['guard']);
                        localStorage.setItem('contactno',response.data['contactno']);
                        localStorage.setItem('roleid',response.data['roleid']);
                        localStorage.setItem('name',response.data['name']);
                    }

                    if(response.data['success'] == false)
                    {
                          this.$toast.show(response.data['message'], {
                          type: "error",
                          position:"top"
                         });
                    }
                 });
             
          }
       }
    }
  </script>
  
  <style>
    .login-page 
    {
      -ms-flex-align: center;
      align-items: center;
      background-color: #e9ecef;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-direction: column;
      flex-direction: column;
      height: 100vh;
      -ms-flex-pack: center;
      justify-content: center;
   }
  
  </style>