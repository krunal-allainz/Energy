import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'qualifiersId':0,
  'qualifiersPage':''
}


// actions
const actions = {
  SetQualifiersId ({commit},qualifiersId) {
    commit(types.SET_QUALIFIERS_ID, qualifiersId)
  },
  SetQualifiersPage ({commit},qualifiersPage) {
    commit(types.SET_QUALIFIERS_PAGE, qualifiersPage)
  },
 }
// mutations
const mutations = {
	[types.SET_QUALIFIERS_ID] (state, qualifiersId) {
    state.qualifiersId = qualifiersId
  },
  [types.SET_QUALIFIERS_PAGE] (state, qualifiersPage) {
    state.qualifiersPage = qualifiersPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}