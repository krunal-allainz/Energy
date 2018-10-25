import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'specialRequestId':0,
  'specialRequestPage':''
}


// actions
const actions = {
  SetSpecialRequestId ({commit},specialRequestId) {
    commit(types.SET_SPECIAL_REQUEST_ID, specialRequestId)
  },
  SetSpecialRequestPage ({commit},specialRequestPage) {
    commit(types.SET_SPECIAL_REQUEST_PAGE, specialRequestPage)
  },
 }
// mutations
const mutations = {
	[types.SET_SPECIAL_REQUEST_ID] (state, specialRequestId) {
    state.specialRequestId = specialRequestId
  },
  [types.SET_SPECIAL_REQUEST_PAGE] (state, specialRequestPage) {
    state.specialRequestPage = specialRequestPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}