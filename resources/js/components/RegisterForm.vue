<template>
<div>
   <div class="h3 mb-4">Создать аккаунт</div>
   <div class="alert alert-success" v-if="message != ''">
      {{message}}
   </div>
   <div class="form-group">
         <label>Email</label>
         <input v-model.trim="email" type="email" class="form-control" placeholder="Введите Email">
   </div>
   <div class="form-group">
         <label>Пароль</label>
         <input v-model="password" type="password" class="form-control" placeholder="Введите пароль">
   </div>
   <button v-if="!isLoading" @click="login" class="btn btn-primary mt-2 w-100">Войти</button>
   <button v-else disabled class="btn btn-primary mt-2 w-100">
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      <span class="sr-only">Loading...</span>
  </button>

  <div class="mt-5 h5">
     Есть аккаунт? <span @click="toggle" class="text-primary cursor-pointer link">Войти</span>
  </div>
</div>
</template>

<script>
    export default {
         data: () => ({
            isLoading: false,
            email: '',
            password: '',
            message: ''
         }),
         methods: {
            toggle() {
               this.$modal.hide('register-modal');
               this.$modal.show('login-modal');
            },
            login() {
               if(this.email.length < 1 || this.password.length < 1) {
                  return false
               }

               this.isLoading = true

               axios.post(api_url + 'register', {
                  email: this.email,
                  password: this.password
               })
                  .then((response) => {
                     if(response.data.success) {
                        location.reload()
                     } else {
                        this.message = response.data.message
                        this.isLoading = false
                     }
                     console.log(response)
                  })
                  .catch((err) => {
                     console.log(err)
                     this.isLoading = false
                  })
            }
         },
         mounted() {
               // console.log('Component mounted.')
         }
    }
</script>
