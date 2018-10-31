import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'nominationId':0,
  'nominationPage':'',
  'nominationDate':'',
}


// actions
const actions = {
  SetNominationId ({commit},nominationId) {
    commit(types.SET_NOMINATION_ID, nominationId)
  },
  SetNominationPage ({commit},nominationPage) {
    commit(types.SET_NOMINATION_PAGE, nominationPage)
  },
  SetNominationDate ({commit},nominationDate) {
    commit(types.SET_NOMINATION_DATE, nominationDate)
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
  [types.SET_NOMINATION_DATE] (state, nominationDate) {
    state.nominationDate = nominationDate
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}