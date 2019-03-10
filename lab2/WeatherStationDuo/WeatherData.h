#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"

using namespace std;

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;
};

class CDisplay : public IObserver<SWeatherInfo>
{
public:
	CDisplay(CWeatherData& inStation, CWeatherData& outStation)
		: m_inStation(inStation),
		m_outStation(outStation)
    {
	};

private:
	void Update(const SWeatherInfo& data, const IObservable<SWeatherInfo>& observable) override
	{	
		if (&observable == &m_inStation)
		{
			std::cout << "State Position in" << std::endl;
		}
		else if (&observable == &m_outStation)
		{
			std::cout << "State Position out" << std::endl;
		}

		std::cout << "Current Temp " << data.temperature << std::endl;
		std::cout << "Current Hum " << data.humidity << std::endl;
		std::cout << "Current Pressure " << data.pressure << std::endl;
		std::cout << "----------------" << std::endl;
	}

	CWeatherData& m_inStation;
	CWeatherData& m_outStation;
};

class CStatsData
{
public:
	void UpdateStatsData(const double sensorType)
	{
		if (m_minValue > sensorType)
		{
			m_minValue = sensorType;
		}
		if (m_maxValue < sensorType)
		{
			m_maxValue = sensorType;
		}
		m_accValue += sensorType;
		++m_countAcc;

		PrintStatsValue();
	}

private:
	void PrintStatsValue()
	{
		cout << "Max " << m_maxValue << endl;
		cout << "Min " << m_minValue << std::endl;
		cout << "Average " << (m_accValue / m_countAcc) << endl;
		cout << "----------------" << endl;
	}

	double m_minValue = numeric_limits<double>::infinity();
	double m_maxValue = -numeric_limits<double>::infinity();
	double m_accValue = 0;
	unsigned m_countAcc = 0;
};

class CStatsDisplay : public IObserver<SWeatherInfo>
{
public:
	CStatsDisplay(CWeatherData& inStation, CWeatherData& outStation)
		: m_inStation(inStation),
		m_outStation(outStation)
	{
		
	}

private:
	void Update(const SWeatherInfo& data, const IObservable<SWeatherInfo>& observable) override
	{
		if (&observable == &m_inStation)
		{
			std::cout << "State Position in" << std::endl;
		}
		else if (&observable == &m_outStation)
		{
			std::cout << "State Position out" << std::endl;
		}

		PrintSensorTypeName("Temperature");
		m_temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		m_humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		m_pressure.UpdateStatsData(data.pressure);
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}

	CStatsData m_temperature;
	CStatsData m_humidity;
	CStatsData m_pressure;

	CWeatherData& m_inStation;
	CWeatherData& m_outStation;
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:
	double GetTemperature()const
	{
		return m_temperature;
	}

	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	std::string GetStationLocation()const
	{
		return m_stationLocation;
	}

	void SetLocationName(std::string const& location)
	{
		m_stationLocation = location;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;

		MeasurementsChanged();
	}

protected:
	SWeatherInfo GetChangedData() const override
	{
		SWeatherInfo info;
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	std::string m_stationLocation;
};
