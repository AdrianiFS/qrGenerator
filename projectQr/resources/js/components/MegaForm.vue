<template>
    <div class="upAndDelFormContainer">
   
    <img id="myImg" src="/images/blank-qr-code.jpg" alt="" />

        <h2>Create URL</h2>
        <form>
            <div class="formInner createFormContainer">
                <input
                    type="text"
                    class=" qrInput generatedUrl"
                    placeholder="generatedUrl"
                    v-model="generatedUrlCreate"
                    ref="generatedUrlCreate"
                />
                <input
                    type="text"
                    class="qrInput redirectionUrl"
                    placeholder="redirectionUrl"
                    v-model="redirectionUrlCreate"
                    ref="redirectionUrlCreate"
                />
                <button
                    class="qrBtn"
                    type="submit"
                    @click.prevent="createResource()"
                >
                    Save
                </button>
                <button class="" @click.prevent="resetForm">
                    Reset
                </button>
            </div>
        </form>
        <h2>Update or delete URL</h2>

        <!-- ******************** -->
          <div ref="qrcode"></div>
        <form>
            <div
                class="formInner updateFormInner"
                v-for="(url, index) in responseAxios"
                :key="index"
               
            >
              <div ref="qrcode"></div>
                <!-- <button  class="printIcon"> -->
                  <a :href="link" target="_blank" ref="qrLink" id="qrLink" >
                  <i class="fas fa-print"></i>
                  </a>
                <!-- </button> -->
                 <!-- <div ref="qrcode"></div> -->
                <input
                    type="text"
                    class=" qrInput"
                    :value="url.generatedUrl"
                    ref="generatedUrl"
                    disabled
                />
        
                <input
                    type="text"
                    class="qrInput"
                    :value="url.redirectionUrl"
                    ref="redirectionUrl"
                   id=""
                />
                <button
                    class="saveBtn"
                    type="submit"
                    @click.prevent="updateResource($refs, index)"
                >
                    <i class="fa fa-save"></i>
                </button>
                <button
                    class="trashBin"
                     @click="deleteChanges(url.id)"
                    @click.prevent="deleteResource($refs, index)"
                >
                    <i class="fa fa-trash "></i>
                </button>
                  <div class="FormValidationContainer">
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li  v-for="error in errors" :key="error"  :class="{displayMessage: errors.length <= 0}">{{ error }} </li>
                    </ul>
                </p>
                     <p >{{status200}}</p>
            </div> 
            </div>
        </form>
    </div>
</template>
<script>
import * as QRCode from 'easyqrcodejs'  
export default {
    data() {
        return {
            generatedUrl: "",
            redirectionUrl: "",
            responseAxios: [],
            updateRes: "",
            generatedUrlCreate: "",
            redirectionUrlCreate: "",
            output: "",
            token: window.token,
            urlData: "",
            responseStatus: "",
            msgOne: "",
            status200: "",
            errors: [],
            link:'queryString?generatedUrl=piso1'
        };
    },
    mounted() {
        this.loadUrl();
        this.displayQrCode()
    },
    methods: {
        loadUrl() {
            axios
                .get("/qrpages/index")
                .then(({ data }) => {
                    this.responseAxios = data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateResource(refs, index) {
            const generatedUrl = refs.generatedUrl[index].value;
            const redirectionUrl = refs.redirectionUrl[index].value;
            // const succesOrFail = refs.succesOrFail[index];
        
            axios
                .post("/qrpages/updateResource", {
                    generatedUrl: generatedUrl,
                    redirectionUrl: redirectionUrl
                })
                .then(response => {
                    response;
                    this.responseStatus = response.status;
                    console.log(this.responseStatus, "actualizar");
                    // console.log(response);
                    this.loadUrl();
                    this.checkForm(redirectionUrl);

                    //let displayMessage= refs.displayMessage[index]
                    // console.log(displayMessage);

                    // console.log(this.responseAxios[index]);
                    // if (response.data === 1) {
                    //     this.$refs["url.id"].forEach(el => {
                    //         el.innerHTML = `<p>data sent</p>`;
                    //     });
                    // }
                    // if (response.data === 0) {
                    // this.$refs["url.id"].forEach(el => {
                    //         el.innerHTML = `<p>data not sent</p>`;
                    //     });
                    // }
                    // if (response.data == 1) {
                    //     succesOrFail.innerHTML = `<p style="color:blue">Data Sent</p>`;
                    //     console.log(succesOrFail);
                    // }
                    // if (response.data == 0) {
                    //     succesOrFail.innerHTML = `<p style="color:red">Data not Sent</p>`;
                    // }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteResource(refs, index) {
            const generatedUrl = refs.generatedUrl[index].value;
            axios
                .post("/qrpages/delete", {
                    generatedUrl: generatedUrl
                })
                .then(response => {
                    response.status;
                    // console.log(generatedUrl);
                    //   this.deleteChanges(generatedUrl)
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm() {
            this.$refs["generatedUrlCreate"].value = "";
            this.$refs["redirectionUrlCreate"].value = "";
        },
        createResource() {
            axios
                .post("/qrpages/store", {
                    generatedUrl: this.generatedUrlCreate,
                    redirectionUrl: this.redirectionUrlCreate
                })
                .then(response => {
                    response.data;
                    this.urlData = response;
                    this.loadUrl();
                    this.updateChangesWhenCreate();
                    // usar response.data para generar un nuevo elemento en el dom
                    //  una vez post resuelto en el then, la respuesta genera un nuevo formulario con los datos actuales de la respuesta
                })
                .catch(error => {
                    console.log(error.response);
                });
        },
        updateChangesWhenCreate() {
            if (
                this.$refs["generatedUrlCreate"].length > 0 &&
                this.$refs["redirectionUrlCreate"].length > 0
            ) {
                this.responseAxios.unshift(this.urlData);
            }
        },
        deleteChanges(id) {
            this.responseAxios = this.responseAxios.filter(url => {
                return url.id !== id;
            });
        },
        checkForm(refs) {
            this.errors = [];
// mettre messages d'erreur display none sauf la ou il faut 
            if (this.responseStatus === 200) {
                this.status200 = "Sent properly to DataBase";
            }
            if (this.responseStatus >= 300) {
                this.errors.push("Not sent properly to DataBase");
            }
            if (!refs) {
                this.errors.push("RedirectionUrl required");
                 this.errors.forEach(e => console.log(e, 'foreach'));
            }
            // console.log(this.errors);
            if (!this.errors.length) {
                return true;
            }
        },
        displayQrCode() {
        // const generatedUrl = this.$refs.generatedUrl;
             let options = {
        text: 'generatedUrl',
        width: 30,
        height: 30,
        colorDark: "#000",
        colorLight: "#fff",
        correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
        dotScale: 1, // Must be greater than 0, less than or equal to 1. default is 1
  
      };
   new QRCode(this.$refs.qrcode, options)

        }
    }
    // variaciones de validaciones
    // 200 ok
    // >=300 no ok
    // ver q tipo de error a dado
};
</script>
<style>
.updateFormInner {
    width: 90% !important;
    margin: 50px auto;
}
.upAndDelFormContainer {
    width: 92%;
    margin: 50px auto;
}
.trashBin,
.saveBtn,
.printIcon {
    width: 30px !important;
}
/* .FormValidationContainer{
} */
.displayMessage {
    display: none;
}
#myImg{
    /* display: none; */
    width: 50px;
    height: 50px;
    }
</style>
