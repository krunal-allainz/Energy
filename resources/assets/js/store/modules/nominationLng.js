import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'nominationLngId':0,
  'nominationLngPage':'',
  'nominationLngDate':'',
}


// actions
const actions = {
  SetNominationLngId ({commit},nominationLngId) {
    commit(types.SET_NOMINATION_LNG_ID, nominationLngId)
  },
  SetNominationLngPage ({commit},nominationLngPage) {
    commit(types.SET_NOMINATION_LNG_PAGE, nominationLngPage)
  },
  SetNominationLngDate ({commit},nominationLngDate) {
    commit(types.SET_NOMINATION_LNG_DATE, nominationLngDate)
  },
 }
// mutations
const mutations = {
	[types.SET_NOMINATION_LNG_ID] (state, nominationLngId) {
    state.nominationLngId = nominationLngId
  },
  [types.SET_NOMINATION_LNG_PAGE] (state, nominationLngPage) {
    state.nominationLngPage = nominationLngPage
  },
  [types.SET_NOMINATION_LNG_DATE] (state, nominationLngDate) {
    state.nominationLngDate = nominationLngDate
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}