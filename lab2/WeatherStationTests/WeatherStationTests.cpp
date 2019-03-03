#include "stdafx.h"
#include "../2.1/Observer.h"
#include "../2.1/WeatherData.h"
#include <vector>
#include <string>

using namespace std;

class CNotifyTests: public IObserver<SWeatherInfo>
{
public:
	CNotifyTests(CObservable<SWeatherInfo>& observable, int observerPriority, vector<int>& prioritiesSet)
		: m_observer_priority(observerPriority),
		m_priorities_set(prioritiesSet)

	{
	}

private:
	void Update(const SWeatherInfo& data) override
	{
		m_priorities_set.push_back(m_observer_priority);
	}

	vector<int> &m_priorities_set;
	int m_observer_priority;
};

class CDeleteTests : public IObserver<SWeatherInfo>
{
public:
	CDeleteTests(CObservable<SWeatherInfo>& observable, int observerPriority)
		: m_observable(observable),
		m_observer_priority(observerPriority)
	{
		m_observable.RegisterObserver(*this, m_observer_priority);
	}

private:
	void Update(const SWeatherInfo& data) override
	{
		m_observable.RemoveObserver(*this);
	}

	CObservable<SWeatherInfo>& m_observable;
	int m_observer_priority;
};

TEST_CASE("Safely notify observers")
{
	CWeatherData weatherData;

	CDeleteTests testObserver1(weatherData, 2);
	weatherData.RegisterObserver(testObserver1, 2);

	REQUIRE_NOTHROW(weatherData.SetMeasurements(-10, 0.8, 761, 10, 90));
};

TEST_CASE("Observer priority testing")
{
	CWeatherData weatherData;
	vector<int> prioritiesSet;
	
	CNotifyTests testObserver1(weatherData, 1, prioritiesSet);
	CNotifyTests testObserver2(weatherData, 2, prioritiesSet);
	CNotifyTests testObserver3(weatherData, 5, prioritiesSet);
	CNotifyTests testObserver4(weatherData, 5, prioritiesSet);
	
	weatherData.RegisterObserver(testObserver1, 1);
	weatherData.RegisterObserver(testObserver2, 2);
	weatherData.RegisterObserver(testObserver3, 5);
	weatherData.RegisterObserver(testObserver4, 5);

	weatherData.NotifyObservers();

	string resultPriorityString = "";
	for (int i = 0; i < prioritiesSet.size(); i++)
	{
		resultPriorityString += to_string(prioritiesSet[i]);
	}

	CHECK(resultPriorityString == "1255");
};