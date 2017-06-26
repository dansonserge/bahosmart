
//signup route
export const initialData='api/initial_data';

export const signupRoute='api/signup';

export const loginRoute='oauth/token';

export const userRoute='api/user';

export const userCategories="api/user_categories";

export const categoriesRoute='api/categories';

export const followCategoryRoute='api/follow/category';

export const followUsersRoute='api/follow/users';

export const followUserRoute='api/follow/user';

export const postsRoute='api/user/posts/';

export const feedsRoute='api/user/feeds/';

export const singlePostRoute='api/single_post/';

export const likePostRoute='api/new/like';

export const sendTest='api/new/test';

export const getMessages='api/messages/';

export const getFollowers='api/user/followers/';

export const challengeRequest='api/users/quiz/request';

export const acceptRequest='api/users/quiz/accept';

export const startChallenge='api/users/quiz/start';

export const addUserAnswers='api/users/quiz/answers';

export const getPrivateRoom='api/users/private_room';

export const sendChat='api/users/add_chat';

export const submitPost='api/new/post';






export const cancelRequestCall='api/users/challenge-call/cancel';









export const getHeader= function(){

const tokenData= JSON.parse(window.localStorage.getItem('authUser'))

const headers = 


{
 'Accept':'application/json',
 'Authorization':'Bearer '+tokenData.access_token
} 

return headers


}