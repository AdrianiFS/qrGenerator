<template>
    <div class="upAndDelFormContainer">
       <div class="formTitle">
            <h2>Create URL</h2>
            </div>
        <form class="forms">
            <div class="formInner createFormContainer">
                <div class="inputContainer" >
                <input
                    type="text"
                    class=" qrInput generatedUrl qrInputCreate"
                    placeholder="Reference"
                    v-model="generatedUrlCreate"
                    ref="generatedUrlCreate"
                    v-focus
                />
                      <i class="far fa-times-circle resetIcon" @click.prevent="resetForm1()"></i>       
            </div>
              
              <div class="inputContainer">
                    <input
                    type="text"
                    class="qrInput redirectionUrl qrInputCreate"
                    placeholder="URL"
                    v-model="redirectionUrlCreate"
                    ref="redirectionUrlCreate"
                />
                        <i class="far fa-times-circle resetIcon" @click.prevent="resetForm2()"></i>
              </div>
                <button
                    class="qrBtn saveBtn"
                    type="submit"
                    @click.prevent="createResource()"
                >
                   <i class="fa fa-plus Iprint"></i>
                </button>
    
            </div>
        </form>
        <div class="formTitle formTitleUpAndDel">
 <h2 id="form2Title ">Update or delete URL</h2>
        </div>
       
        <!-- ******************** -->
         
        <form class="forms">
              <!-- <label for="searchInput">Search:</label>
        <input v-model="searchInput" type="text"/> -->

            <div
                class="formInner updateFormInner"
                v-for="(url, index) in responseAxios"
                :key="index"
                :class="{everyOtherColor: index % 2 == 0}"
            >
  
               <div  v-for="(error) in errors" :key="error" class="FormValidationContainer">
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li >{{ error }}</li>
                    </ul>
                </p>
                <p >{{status200}}</p>
            </div> 
               <a :href="link + url.generatedUrl"  target="_blank" id="qrLink">
                  <i class="fas fa-print Iprint" ></i>
                  </a>
                <input
                    id="generatedUrl"
                    type="text"
                    class=" qrInput generatedUrl"
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
                    <i class="fa fa-save Isave"></i>
                </button>
                <button
                    class="trashBin"
                    @click="deleteChanges(url.id)"
                    @click.prevent="deleteResource($refs, index)"
                >
                    <i class="fa fa-trash ItrashBin"></i>
                </button>

               
            </div>
        </form>
    </div>
</template>
<script>
import * as QRCode from 'easyqrcodejs'  
export default {
    data() {
        return {
            responseAxios: [],
            updateRes: "",
            generatedUrlCreate: "",
            redirectionUrlCreate: "",
            generatedUrl: "",
            redirectionUrl: "",
            output: "",
            token: window.token,
            urlData: "",
            responseStatus: "",
            msgOne: "",
            status200: "",
            errors: [],
            // link:'http://f22918c0d2fa.ngrok.io/qrpages/qrGenerator?generatedUrl='
            link:'http://127.0.0.1:8000/qrpages/qrGenerator?generatedUrl=',
            searchInput:''
           
        };
    },
      directives: {
    focus: {
      inserted: function (el) {
        el.focus();
      },
    },
  },
    mounted() {
        this.loadUrl();
    }, 
    computed: {
         filteredUrl: function () {
     this.responseAxios.filter((url) => {
        return url.generatedUrl.match(this.searchInput);
    //  console.log(this.responseAxios.forEach(el=>console.log(el.generatedUrl)));

      });
    },
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
        updateResource(refs, id) {
            const generatedUrl = refs.generatedUrl[id].value;
            const redirectionUrl = refs.redirectionUrl[id].value;   
            // let formPosition= this.$refs.formPosition.indexOf(this.$refs.formPosition[id]);
             this.link += refs.generatedUrl[id].value
            axios
                .post("/qrpages/updateResource", {
                    generatedUrl: generatedUrl,
                    redirectionUrl: redirectionUrl
                })
                .then(response => {
                    response;
                    this.responseStatus = response.status;
                    this.loadUrl();
                    this.checkForm(redirectionUrl);
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
              
                })
                .catch(error => {
                    console.log(error);
                });
        },
        resetForm1() {
            this.$refs["generatedUrlCreate"].value = "";
        },
          resetForm2() {
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
            // console.log(refs, index, 'check form');
            // let formPosition= this.$refs.formPosition.indexOf(this.$refs.formPosition[id]);
            // console.log(this.$refs.formPosition.indexOf(this.$refs.formPosition[index]) );
            if (this.responseStatus === 200) {
                // this.status200 = "Sent properly to DataBase";
                // alert( "Sent properly to DataBase");
            }
            if (this.responseStatus >= 300) {
                // this.errors.push("Not sent properly to DataBase");
                alert("Not sent properly to DataBase")
            }
            if (!refs) {
             this.errors.push("RedirectionUrl required");
          
                //  this.errors.forEach(e => console.log(e, 'foreach'));
            }
            if (!this.errors.length) {
                return true;
            }
        },    
    }
};
</script>
<style>
.updateFormInner {
    width: 100% !important;
    margin: 0 auto;
}
.upAndDelFormContainer {
    width: 92%;
    margin: 50px auto;
}
.trashBin,
.saveBtn,
.printIcon {
    width: 30px !important;
    background: none;
    /* border: none !important; */
}

.Iprint{
/* color: rgb(6, 86, 172); */
 color: #435d7d;
}
.Isave{
color: rgb(255, 202, 40);
}
.ItrashBin{
color: rgb(241, 89, 156);
}
.displayMessage {
    display: none;
}
#myImg{
    width: 50px;
    height: 50px;
    }
    .inputContainer{
        position: relative;
        width: 30%;
    }
   .qrInput{
       position: relative;
   }
.resetIcon{
    position: absolute;
    right: 5%;
    top: 30% !important;
    color: gray;
    
}




.qrInputCreate{
    width: 100% !important;
}
.everyOtherColor{
background-color: rgb(251, 251, 251);
}
</style>
