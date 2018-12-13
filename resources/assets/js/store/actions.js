import * as types from './mutation-types.js'

export const setDashboardType = ({ commit }, dashboardType) => {
	commit(types.SET_DASHBOARD_TYPE, dashboardType)
}
// export const setCurrentScheduleView = ({ commit }, currentScheduleView) => {
// 	commit(types.SET_CURRENT_SCHEDULE_VIEW, currentScheduleView)
// }

// export const setCurrentView = ({ commit }, setCurrentView) => {
//   commit(types.SET_CURRENT_VIEW, setCurrentView)
// }

// export const isAdmin = ({ commit }, isAdmin) => {
//   commit(types.IS_ADMIN, isAdmin)
// }
/*export const setTournament = ({ commit }, tournament) => {
  commit(types.CURRENT_TOURNAMENT, selectedAction)
}*/
