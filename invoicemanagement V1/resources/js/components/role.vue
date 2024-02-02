<template>
    <div class="container">
                    <h1>role Component</h1>        
    </div>
</template>
<script>
export default{
    data(){
        return{
permissions:[]
        }
    },
    methods:{
        getPermissions(){
            axios.get("http://127.0.0.1:8000/getAllPermission")
            .then((response)=>{
                 this.permissions=response.data.permissions
            })
        }
    },
    created(){
        this.getPermissions();
    }
}
</script>