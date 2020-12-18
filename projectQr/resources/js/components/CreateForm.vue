<template>
    <div>
        <form class="" @submit="formSubmit">
            <!-- <input type="hidden" name="_token" :value="csrf" /> -->
            <!-- <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/> -->
            <div class="formInner createFormContainer">
                <input
                    type="text"
                    class=" qrInput generatedUrl"
                    placeholder="generatedUrl"
                    v-model="generatedUrl"
                    ref="generatedUrl"
                />
                <input
                    type="text"
                    class="qrInput redirectionUrl"
                    placeholder="redirectionUrl"
                    v-model="redirectionUrl"
                    ref="redirectionUrl"
                />
                <button class="qrBtn" type="submit">Save</button>
                <button class="" @click.prevent="resetForm">Reset</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    mounted() {
        // console.log(window.Laravel);
        // console.log("gagnam style");
    },
    data() {
        return {
            generatedUrl: "",
            redirectionUrl: "",
            output: "",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    methods: {
        resetForm() {
            this.$refs["generatedUrl"].value = "";
            this.$refs["redirectionUrl"].value = "";
        },
        formSubmit() {
            axios
                .post("/qrpages/store", {
                    generatedUrl: this.generatedUrl,
                    redirectionUrl: this.redirectionUrl,
                    headers: {
                        token: this.csrf
                    }
                })
                .then(response => {
                    response.data;
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    }
};
</script>

<style></style>
