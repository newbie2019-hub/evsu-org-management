<template>
 <div>
  <div class="container pt-5">
   <div class="row ">
    <h5 class="">Announcement Section</h5>
    <p class="text-muted">Organization announcements are listed below</p>
    <div class="col-12 col-sm-11 col-md-12 col-lg-11 col-xl-11 mt-4">
     <div class="card p-5">
      <div class="table-responsive mt-4">
       <table class="table table-striped table-hover">
        <caption>
         Showing
         {{
          allannouncements.from
         }}
         to
         {{
          allannouncements.to
         }}
         out of
         {{
          allannouncements.total
         }}
         data
        </caption>
        <thead>
         <tr>
          <th scope="col">ID</th>
          <th class="cursor-pointer" v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'">
           What
           <i class="bi" :class="sort == 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"></i>
          </th>
          <th scope="col">Where</th>
          <th scope="col">When</th>
          <th scope="col">Who</th>
          <th scope="col">Organization</th>
          <th scope="col">Action</th>
         </tr>
        </thead>
        <tbody>
         <tr v-for="(announcement, i) in allannouncements.data" :key="i">
          <td scope="row">{{ i + allannouncements.from }}</td>
          <td>{{ announcement.what }}</td>
          <td>{{ announcement.where }}</td>
          <td>{{ announcement.when }}</td>
          <td>{{ announcement.who }}</td>
          <td>{{ announcement.organization.organization }}</td>
          <td>
           <div class="d-flex">
            <a
             v-on:click.prevent="
              delete_data.id = announcement.id;
              $bvModal.show('deleteAnnouncementModal');
             "
             href=""
             class="btn btn-danger btn-sm rounded-pill"
             ><i class="bi bi-trash"></i
            ></a>
           </div>
          </td>
         </tr>
        </tbody>
       </table>
       <div class="row mt-3" v-if="allannouncements.data">
        <pagination :showDisabled="true" :align="'right'" :data="allannouncements" @pagination-change-page="getAnnouncements">
         <span slot="prev-nav">&laquo;</span>
         <span slot="next-nav">&raquo;</span>
        </pagination>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>

  <b-modal id="deleteAnnouncementModal" centered title="Confirm Delete">
   <p>Are you sure you want to delete?</p>
   <template #modal-footer="{cancel}">
    <b-button variant="primary" size="sm" @click="cancel()" :disabled="isLoading">
     Cancel
    </b-button>
    <b-button variant="success" size="sm" v-on:click.prevent="deleteAnnouncement" :disabled="isLoading">
     Delete
    </b-button>
   </template>
  </b-modal>
 </div>
</template>
<script>
 import { mapState } from 'vuex';
 export default {
  data() {
   return {
    delete_data: {
     id: '',
    },
    sort: 'asc',
   };
  },
  async mounted() {
   document.title = 'Organization Announcements';
   await this.$store.dispatch('auth/checkAdminUser');
   this.getAnnouncements();
   this.$root.$on('bv::modal::show', (modalId) => {
    this.modalId = modalId.componentId;
   });
   this.$root.$on('bv::modal::hide', (modalId) => {});
  },
  computed: {
   ...mapState('announcement', ['allannouncements']),
   ...mapState('auth', ['user']),
  },
  methods: {
   async getAnnouncements(page = 1) {
    await this.$store.dispatch('announcement/allAnnouncements', {
     page: page,
     sort: this.sort,
    });
   },
   async deleteAnnouncement() {
    this.isLoading = true;
    const { data, status } = await this.$store.dispatch('announcement/deleteAnnouncement', this.delete_data);
    this.checkStatus(data, status, '', 'announcement/allAnnouncements', '');
   },
   closeModal() {
    this.$bvModal.hide(this.modalId);
   },
  },
  watch: {
   sort() {
    this.getAnnouncements();
   },
  },
 };
</script>
