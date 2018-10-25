import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'laboratoryId':0,
  'laboratoryPage':''
}


// actions
const actions = {
  SetLaboratoryId ({commit},laboratoryId) {
    commit(types.SET_LABORATORY_ID, laboratoryId)
  },
  SetLaboratoryPage ({commit},laboratoryPage) {
    commit(types.SET_LABORATORY_PAGE, laboratoryPage)
  },
 }
// mutations
const mutations = {
	[types.SET_LABORATORY_ID] (state, laboratoryId) {
    state.laboratoryId = laboratoryId
  },
  [types.SET_LABORATORY_PAGE] (state, laboratoryPage) {
    state.laboratoryPage = laboratoryPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}