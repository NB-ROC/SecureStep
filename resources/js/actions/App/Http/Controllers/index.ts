import Auth from './Auth'
import ProfileController from './ProfileController'
import FriendController from './FriendController'
import FollowController from './FollowController'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    ProfileController: Object.assign(ProfileController, ProfileController),
    FriendController: Object.assign(FriendController, FriendController),
    FollowController: Object.assign(FollowController, FollowController),
}

export default Controllers