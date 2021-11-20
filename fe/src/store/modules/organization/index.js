import API from '../../base/'

export default {
  namespaced: true,
  state: {
    organizations: [],
    allorganizations: [],
  },
  getters: {
    
  },
  mutations: {
    SET_ALL_ORGANIZATIONS(state, data) {
      state.allorganizations = data
    },
    SET_ORGANIZATIONS(state, data) {
      state.organizations = data
    },
    UPDATE_ORGANIZATION(state, data) {
      for(let i = 0; i < state.organizations.data.length; i++){
        if(state.organizations.data[i].id == data.id){
         state.organizations.data[i].organization = data.organization
         state.organizations.data[i].abbreviation = data.abbreviation
        }
       }
    }
  },
  actions: {
    async allOrganizations({commit}){
      const res = await API.get(`/admin/organization/all`).then(res => {
        commit('SET_ALL_ORGANIZATIONS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
     },
    async getOrganizations({commit}, {page, sort}){
      const res = await API.get(`/admin/organization?page=${page}&sort=${sort}`).then(res => {
        commit('SET_ORGANIZATIONS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
     },
    async searchOrganizations({commit}, {page, sort, data}){
      const res = await API.post(`/admin/search/organization?page=${page}&sort=${sort}`, data).then(res => {
        commit('SET_ORGANIZATIONS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
     },
     async saveOrganization({commit}, payload){
       const res = await API.post('/admin/organization', payload).then(res => {
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
     async updateOrganization({commit}, payload){
       const res = await API.put(`/admin/organization/${payload.id}`, payload).then(res => {
         commit('UPDATE_ORGANIZATION', payload);
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
     async deleteOrganization({commit}, payload){
       const res = await API.delete(`/admin/organization/${payload.id}`).then(res => {
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
  
      /** END OF ACTION */
  },
}