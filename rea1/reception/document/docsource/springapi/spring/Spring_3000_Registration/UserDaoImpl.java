package com.bjsxt.registration.dao.impl;

import java.util.List;

import javax.annotation.Resource;

import org.hibernate.criterion.DetachedCriteria;
import org.springframework.orm.hibernate3.HibernateTemplate;
import org.springframework.stereotype.Component;

import com.bjsxt.registration.dao.UserDao;
import com.bjsxt.registration.model.User;

@Component("userDao")
public class UserDaoImpl implements UserDao {
	
	private HibernateTemplate hibernateTemplate; 
	public void save(User u) {
		hibernateTemplate.save(u);
		
	}

	public boolean checkUserExistsWithName(String username) {
		List<User> users = hibernateTemplate.find("from User u where u.username = '" + username + "'");
		
		
		if(users != null && users.size() > 0) {
			return true;
		}
		return false;
		/*long count = (Long)hibernateTemplate.getSessionFactory()
					.getCurrentSession().createQuery("select count(*) from User u where u.username = :username")
					.setString("username", username).uniqueResult();
		if(count > 0) return true;
		return false;*/
	}

	public HibernateTemplate getHibernateTemplate() {
		return hibernateTemplate;
	}
	
	@Resource
	public void setHibernateTemplate(HibernateTemplate hibernateTemplate) {
		this.hibernateTemplate = hibernateTemplate;
	}

	public List<User> getUsers() {
		// TODO Auto-generated method stub
		return (List<User>)this.hibernateTemplate.find("from User");
	}

	public User loadById(int id) {
		
		return (User)this.hibernateTemplate.load(User.class, id);
	}

}
