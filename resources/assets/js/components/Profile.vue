<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 220px !important;
}
.widget-user .card-footer{
    padding: 0;
}
.widget-user .widget-user-image > img {
    width: 150px !important;
    height: 150px !important;
    margin-left: -30px !important;
}
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./img/hero.png')">
               
                    <h3 class="widget-user-username">{{this.form.firstname}} {{this.form.lastname}}</h3>
                    <h5 class="widget-user-desc" >ID Number: {{this.form.id_num}}</h5>

                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" :src="getProfilePhoto()" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">Year Level</h5>
                        <span class="description-text">{{this.form.year_level}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">Section</h5>
                        <span class="description-text">{{this.form.section}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">Program</h5>
                        <span class="description-text">{{this.form.acad_program}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#information" data-toggle="tab">Information</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="information">
                                <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email Address</label>

                                    <div class="col-sm-12">
                                    <input readonly type="text" v-model="form.cd_email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                     <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputSuffixname" class="col-sm-2 control-label">Suffix Name</label>

                                    <div class="col-sm-12">
                                    <input type="text" v-model="form.suffixname" class="form-control" id="inputSuffixname" placeholder="Suffix Name" :class="{ 'is-invalid': form.errors.has('suffixname') }">
                                     <has-error :form="form" field="suffixname"></has-error>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <!-- <label for="password" class="col-sm-12 control-label">Password (leave blank if you don't want to change it)</label> -->

                                    <div class="col-sm-12">
                                    <input type="hidden"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-primary">Update <i class="fas fa-pen fa-fw"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                 form: new Form({
                     //important details
                    id : '',
                    id_num : '',
                    cd_email:'',
                    firstname : '',
                    middlename : '',
                    lastname : '',
                    year_level: '',
                    section:'',
                    acad_program:'',
                    profile_photo: '',
                    student_type: '',
                    //supporting details
                    suffixname:'',
                    scholarship:'',
                    sex:'',
                    civil_status:'',
                    citizenship:'',
                    birthplace:'',
                    religion:'',
                    dob:'',
                    //current address
                    ca_st_num:'',
                    ca_st_name:'',
                    ca_subd:'',
                    ca_brgy:'',
                    ca_city:'',
                    ca_province:'',
                    ca_zipcode:'',
                    //permanent address
                    per_st_num:'',
                    per_st_name:'',
                    per_subd:'',
                    per_brgy:'',
                    per_city:'',
                    per_province:'',
                    per_zipcode:'',
                    //contact details
                    cd_telno:'',
                    cd_mobno:'',
                    //school attended
                    lsa_schtype:'',
                    lsa_schname:'',
                    lsa_schprogram:'',
                    lsa_schattended:'',
                    //parent information
                    //father
                    fa_name:'',
                    fa_mname:'',
                    fa_lname:'',
                    fa_sname:'',
                    fa_mobno:'',
                    fa_email:'',
                    fa_occu:'',
                    //mother
                    mo_name:'',
                    mo_mname:'',
                    mo_lname:'',
                    mo_mobno:'',
                    mo_email:'',
                    mo_occu:'',
                    //guardian
                    gu_name:'',
                    gu_mname:'',
                    gu_lname:'',
                    gu_sname:'',
                    gu_mobno:'',
                    gu_email:'',
                    gu_occu:'',
                    gu_rel:'',

                })               
   
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getProfilePhoto(){
                let profile_photo = (this.form.profile_photo.length > 200) ? this.form.profile_photo : "img/profile/"+ this.form.profile_photo ;
                return profile_photo;
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/student /'+this.form.id)
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            // updateProfile(e){
            //     // console.log('uploading');
            //         let file = e.target.files[0];
            //         // console.log(file);
            //         let reader = new FileReader();
            //         // let vm = this;
            //         if(file['size'] < 2111775){
            //             reader.onloadend = (file) => {
            //                 // console.log('RESULT', reader.result)
            //                 this.form.profile_photo = reader.result;
            //             }
            //             reader.readAsDataURL(file);
            //         }else{
            //              swal({
            //                 type: 'error',
            //                 title: 'Exceeded File Size',
            //                 text: 'Maximum upload image file size: 2 MB',
            //             })
            //         }
            // }
        },
        created() {
                // axios.get("api/profile")
                // .then(({ data }) => (this.form.fill(data)));
                axios.get("api/student").then(({ data }) => (this.form.fill(data)));
                // axios.get("api/user").then(({data}) =>(this.users = data.data));

        }
    }
</script>