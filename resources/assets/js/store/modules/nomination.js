import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'nominationId':0,
  'nominationPage':''
}


// actions
const actions = {
  SetNominationId ({commit},nominationId) {
    commit(types.SET_NOMINATION_ID, nominationId)
  },
  SetNominationPage ({commit},nominationPage) {
    commit(types.SET_NOMINATION_PAGE, nominationPage)
  },
 }
// mutations
const mutations = {
	[types.SET_NOMINATION_ID] (state, nominationId) {
    state.nominationId = nominationId
  },
  [types.SET_NOMINATION_PAGE] (state, nominationPage) {
    state.nominationPage = nominationPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}