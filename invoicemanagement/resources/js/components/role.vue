<template>
<div>
    <h1>You got it</h1>
</div>
</template>

<!-- <script>
export default {
    data(){
        return{
            dis: true,
            permissions: [],
            form: new Form({
                'name' : '',
                'permissions' : []
            })
        }
    },
    methods:{
        getPermissions(){
            axios.get("/getAllPermission")
            .then((response)=>{
                this.permissions = response.data.permissions
            }).catch(()=>{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            });
        },
        createRole(){
            this.dis = false;
            this.form.post("/postRole").then(()=>{
                swal.fire({
                    icon: 'success',
                    title: 'Role Created',
                    text: 'Your Role has been created',
                })
                window.location = "/role";
            }).catch(()=>{
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            });
            this.dis=true;
        }
    },
    created(){
        this.getPermissions();
    }
}
</script> -->
