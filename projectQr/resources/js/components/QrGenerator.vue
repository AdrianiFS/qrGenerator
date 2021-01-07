<template>
<div class="main">
        <div ref="qrcode"></div>
 <h1>qr-generator Component</h1>
 <div v-for="url in responseAxios" :key="url.id">
     <p>{{ url.url }}</p>
 </div>
 <button @click="handleResponse()">click</button>
</div>
</template>
<script>
import * as QRCode from 'easyqrcodejs'   
export default {
data() {
    return {
        test:'hola',
        responseAxios:[],
        urlResponse: []
    }
},
// mounted () {
//   this.getParam();
// },

created () {
      this.getParam();
   this.handleResponse()
// se renderiza en dom, pero da objeto vacio, chino hdp
},
methods: {
    getParam() {
         axios
           .get("qrGenerator?generatedUrl=undefined")

                .then(response => {
                  this.responseAxios =  response;
            //    console.log(response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
    },handleResponse(){
console.log(this.responseAxios,'handleResponse');
}
},

}
</script>

<style>

</style>