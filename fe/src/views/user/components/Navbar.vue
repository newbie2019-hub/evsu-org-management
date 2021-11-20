<template>
 <div>
  <div class="navigation" v-if="user.userinfo">
   <b-avatar variant="info" v-if="user.image" :src="`http://127.0.0.1:8000/uploads/` + user.image"></b-avatar>
   <b-avatar variant="info" v-else :text="user.userinfo.first_name[0] + user.userinfo.last_name[0]"></b-avatar>
   <div class="d-flex flex-column lh-0">
    <p class="text-dark username" v-if="user">{{ user.userinfo.first_name }} {{ user.userinfo.last_name }}!</p>
    <p class="text-muted username" v-if="user">
     <small>{{ user.email }}</small>
    </p>
    <p class="text-muted username" v-if="user">
     <small>S.Y. {{ user.userinfo.academic_year }}</small>
    </p>
   </div>
  </div>
 </div>
</template>
<script>
 import { mapState, mapActions } from 'vuex';
 export default {
  async mounted() {
   await this.checkUser();
  },
  computed: {
   ...mapState('auth', ['user']),
  },
  methods: {
   ...mapActions('auth', ['checkUser']),
  },
 };
</script>
