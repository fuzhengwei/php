package com.bjsxt.dao.impl;

import javax.annotation.Resource;

import org.hibernate.Session;
import org.springframework.orm.hibernate3.HibernateTemplate;
import org.springframework.stereotype.Component;

import com.bjsxt.dao.UserDAO;
import com.bjsxt.model.User;

@Component("u") 
public class UserDAOImpl extends SuperDAO implements UserDAO {

	//new UserDAOImpl( new AbstractDAO

	public void save(User user) {
		
			this.getHibernateTemplate().save(user);
			
		//throw new RuntimeException("exeption!");
	}

}
