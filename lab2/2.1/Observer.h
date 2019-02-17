#pragma once
#include <set>
#include <functional>

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
	virtual void RegisterObserver(IObserver<T> & observer) = 0;
	virtual void NotifyObservers() = 0;
	virtual void RemoveObserver(IObserver<T> & observer) = 0;
};

template <class T>
class CObservable : public IObservable<T>
{
public:
	typedef IObserver<T> ObserverType;

	void RegisterObserver(ObserverType & observer) override
	{
		m_observers.insert(&observer);
	}

	void NotifyObservers() override
	{
		T data = GetChangedData();
		set<ObserverType *> observers;
		copy(observers, m_observers);

		for (auto & observer : observers)
		{
			observer->Update(data);
		}
	}

	void RemoveObserver(ObserverType & observer) override
	{
		m_observers.erase(&observer);
	}

protected:
	//  лассы-наследники должны перегрузить данный метод, 
	// в котором возвращать информацию об изменени¤х в объекте
	virtual T GetChangedData()const = 0;

private:
	set<ObserverType *> m_observers;
};

