package com.bjsxt.service;
import java.lang.reflect.Proxy;

import org.junit.Test;

import com.bjsxt.aop.LogInterceptor;
import com.bjsxt.dao.UserDAO;
import com.bjsxt.dao.impl.UserDAOImpl;
import com.bjsxt.model.User;
import com.bjsxt.spring.BeanFactory;
import com.bjsxt.spring.ClassPathXmlApplicationContext;


public class UserServiceTest {

	@Test
	public void testAdd() throws Exception {
		BeanFactory applicationContext = new ClassPathXmlApplicationContext();
		
		
		UserService service = (UserService)applicationContext.getBean("userService");
			
		
		User u = new User();
		u.setUsername("zhangsan");
		u.setPassword("zhangsan");
		service.add(u);
	}
	
	@Test
	public void testProxy() {
		UserDAO userDAO = new UserDAOImpl();
		LogInterceptor li = new LogInterceptor();
		li.setTarget(userDAO);
		UserDAO userDAOProxy = (UserDAO)Proxy.newProxyInstance(userDAO.getClass().getClassLoader(), userDAO.getClass().getInterfaces(), li);
		System.out.println(userDAOProxy.getClass());
		userDAOProxy.delete();
		userDAOProxy.save(new User());
		
	}
	
	/*class $Proxy4 implements UserDAO 
	 * {
	 * 	save(User u) {
	 * 	Method m = UserDAO.getclass.getmethod 
	 * li.invoke(this, m, u)
	 * }
	 * }
	 */

}
