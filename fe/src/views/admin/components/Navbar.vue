<template>
  <div>
    <div class="navigation" v-if="user.admininfo">
      <b-avatar variant="info" v-if="user.admininfo.image" :src="`http://127.0.0.1:8000/uploads/` + user.admininfo.image"></b-avatar>
      <b-avatar variant="info" v-else :text="user.admininfo.first_name[0] + user.admininfo.last_name[0]"></b-avatar>
      <div class="d-flex flex-column">
        <p class="text-dark username lh-sm" v-if="user">
          Welcome, {{ user.admininfo.first_name }}
          {{ user.admininfo.last_name }}!
        </p>
        <p class="text-muted username lh-sm" v-if="user">
          <small>{{ user.email }}</small>
        </p>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
export default {
  async mounted() {
    await this.checkAdminUser();
  },
  computed: {
    ...mapState("auth", ["user"]),
  },
  methods: {
    ...mapActions("auth", ["checkAdminUser"]),
  },
};
</script>
