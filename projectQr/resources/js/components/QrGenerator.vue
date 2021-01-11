<template>
<div class="main">
     <!-- <h1 >qr-generator Component</h1> -->
     <button @click="print" ref="printButton"  class="iPrintQrComp">
          <i class="fas fa-print Iprint "></i>
     </button>
     <div id="qrCodePrint">
  <div ref="qrcode" id="qrcode"></div>
     </div>
  
</div>
</template>
<script>
import * as QRCode from 'easyqrcodejs';  
// import Vue from 'vue';
// import VueHtmlToPaper from 'vue-html-to-paper';


export default {
   
data() {
    return {
        test:'hola',
        responseAxios:[],
        urlResponse:[],
        output: null
    }
},mounted () {
      this.getParam();
      this.displayQr();
},
methods: {
    getParam() {
         axios
           .get("/qrpages/qrGeneratorData")
                .then(response => {
                  this.responseAxios =  response;
            //    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
    },handleResponse(){
// console.log(this.responseAxios.data,'handleResponse');
// console.log(window.location.href);
 let url =window.location.href;
 let finalUrl = url.replace(/qrGenerator/, 'queryString');
},
displayQr(){
 let url = window.location.href;
 let finalUrl = url.replace(/qrGenerator/, 'queryString');
 console.log(finalUrl );
 console.log(url);
 let options = {
        text:finalUrl,
        // text:'https://www.qrprosolutions',
        width: 300,
        height:300,
        colorDark: "#000",
        colorLight: "#fff",
        correctLevel: QRCode.CorrectLevel.H,
        dotScale: 1, 
      };

      new QRCode(this.$refs.qrcode, options); 

  },print(){
    //   this.$refs.printButton.style.display='none';
      window.print()

//   vue-html-to-paper
        //  this.$htmlToPaper('qrCodePrint');
     
  }
 },
}
</script>
<style scoped>
#qrcode{
    width: 300px;
    margin: 70px auto;
}
h1{
    text-align: center;
}
.iPrintQrComp{
    position: absolute;
    top: 15%;
    right: 1%;
}

/* .navbar {
    display: none !important;
} */
</style>