#pragma once
#include <set>
#include <functional>
#include <map>
#include <iterator>
#include "InterestEvents.h"

template <typename T>
class IObserver
{
public:
	virtual void Update(T const& data) = 0;
	virtual ~IObserver() = default;
};

template <typename T>
class IObservable
{
public:
	virtual ~IObservable() = default;
	virtual void RegisterObserver(IObserver<T> & observer, int priority, InterestingEvents& events) = 0;
	virtual void NotifyObservers() = 0;
	virtual void RemoveObserver(IObserver<T> & observer) = 0;
};

template <class T>
class CObservable : public IObservable<T>
{
public:
	typedef IObserver<T> ObserverType;

	void RegisterObserver(ObserverType & observer, int priority, InterestingEvents& events) override
	{
		m_observers.insert(std::pair<int, ObserverType *>(priority, &observer));
	}

	void NotifyObservers() override
	{
		T data = GetChangedData();
		std::multimap<int, ObserverType *> observers;
		observers = m_observers;

		for (std::pair<int, ObserverType *> currObserver : observers)
		{
			currObserver.second->Update(data);
		}
	}

	void RemoveObserver(ObserverType & observer) override
	{
		ObserverType * currObserver = &observer;
		for (auto it = m_observers.begin(); it != m_observers.end(); ++it)
		{
			if (it->second == currObserver)
			{
				m_observers.erase(it);
				break;
			}
		}
	}

protected:
	virtual T GetChangedData()const = 0;

private:
	std::multimap<int, ObserverType *> m_observers;
};

