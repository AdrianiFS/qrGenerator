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
mounted () {
  this.getParam();
},

// ,created() {
// this.handleResponse()
// aunque ponga getParam en created no hay nada en array, mismo ambas en mounted, es una mierda esto
// ///app.js:2317 [__ob__: Observer]length: 0__ob__: Observerdep: Depid: 10subs: []__proto__: Objectvalue: [__ob__: Observer]vmCount: 0__proto__: ObjectobserveArray: ƒ observeArray(items)walk: ƒ walk(obj)constructor: ƒ Observer(value)__proto__: Object__proto__: Array
// },

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