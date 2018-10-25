import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'prescriptionId':0,
  'prescriptionPage':''
}


// actions
const actions = {
  SetPrescriptionId ({commit},prescriptionId) {
    commit(types.SET_PRESCRIPTION_ID, prescriptionId)
  },
  SetPrescriptionPage ({commit},prescriptionPage) {
    commit(types.SET_PRESCRIPTION_PAGE, prescriptionPage)
  },
 }
// mutations
const mutations = {
	[types.SET_PRESCRIPTION_ID] (state, prescriptionId) {
    state.prescriptionId = prescriptionId
  },
  [types.SET_PRESCRIPTION_PAGE] (state, prescriptionPage) {
    state.prescriptionPage = prescriptionPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}